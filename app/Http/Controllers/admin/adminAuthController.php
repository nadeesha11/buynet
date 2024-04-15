<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class adminAuthController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function authCheck(Request $request){
      
        $request->validate([
            'name' => "required|max:100",
            'password' => 'required|max:100',
          ]);
      
          $credentials = $request->only('name', 'password');
         
          try {
            if (Auth::attempt($credentials)) {
            
                //check user activated or not
                $check_admin = DB::table('users')->where('name', $request->name)->where('status', 1)->first();
                session(['admin_data' => $check_admin]);
            
                if($check_admin){
                   
                }
                else{
                   return response()->json(['code' => 'false', 'msg' => "Your Account Deactivated."]);
                }
                
                // check remember me token clicked or not start
                if (isset($request->remember)) {
                  Cookie::queue('buynet_username', $request->name, 1440);
                  Cookie::queue('buynet_password', $request->password, 1440);
                }
                return response()->json(['code' => 'true', 'msg' => "Login Success"]);
              } else {
                return response()->json(['code' => 'false', 'msg' => "The username and password do not match."]);
              } 
          } catch (\Throwable $th) {
            return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
          }
         
    }

    public function dashBoard(){
        try {
            $adminData = session('admin_data');
        if($adminData->user_type == 2){
         return view('admin.adminManagement');
        }
        else if($adminData->user_type == 1){
         return "admin";
        }
        } catch (\Throwable $th) {
           return view('admin.login');
        }
      
    }

    public function logout(){
      Session::flush();
      Auth::logout();
      return redirect()->route('admin.login');
    }

    public function forgetPassword(){
     return view('admin.forgetPassword'); 
    }

    public function forgetPasswordMail(Request $request){
      $request->validate([
        'mail' => 'required|email|exists:users,email|max:100',
      ]);

      try {
        $token = \Str::random(64);
        $query = DB::table('password_reset_tokens')->where('email', $request->mail);
        if ($query->exists()) {
          DB::table('password_reset_tokens')->where('email', $request->mail)->update([
            'token' => $token,
            'created_at' => Carbon::now()->addMinutes(15),
          ]);
        } else {
          DB::table('password_reset_tokens')->insert([
            'email' => $request->mail,
            'token' => $token,
            'created_at' => Carbon::now()->addMinutes(15),
          ]);
        }
    
        $action_link = route('forget_password_link.email', ['token' => $token]);
        $body = "we are recieved a request to reset the password for <b>buynet</b> account associated with " . $request->mail . ". You can reset your password by clicking the link below ";
    
        $result =  \Mail::send('email-forgot', ['action_link' => $action_link, 'body' => $body], function ($message) use ($request) {
          $message->from('jayathilaka221b@gmail.com', 'buynet');
          $message->to($request->mail, 'your name')->subject('Reset password');
        });
        if ($result) {
          return response()->json(['code' => 'true', 'msg' => "We sent you a mail, please check your mails."]);
        } else {
          return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
        }
      } catch (\Throwable $th) {
        return response()->json(['code' => 'false', 'msg' => $th->getMessage()]);
      }
  
    }

    public function forget_password_link($token){
    return view('admin.resetPassword',compact('token'));
    }

    public function resetPassword(Request $request){
   
    $check_expired = DB::table('password_reset_tokens')->where(['token' => $request->token])->first();
    $check_time = Carbon::parse($check_expired->created_at);
    $current_time = Carbon::now();
    if ($check_time->gt($current_time)) {
      $request->validate(
        [
          'password' => ['required', 'confirmed', 'max:20', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
        ]
      );
      //check token available or not 
      $reset = DB::table('password_reset_tokens')->where(['token' => $request->token])->first();
      if ($reset) {
        // change password 
        $change =  DB::table('users')->where('email', $reset->email)->update(
          ['password' => Hash::make($request->password)]
        );
        if ($change) {
          return response()->json(['code' => 'false', 'msg' => "Password Changed."]);
        } else {
          return response()->json(['code' => 'true', 'msg' => "The username and password do not match."]);
        }
      } else {
        return response()->json(['code' => 'false', 'msg' => "Invalid Token."]);
      }
    } else {
      return response()->json(['code' => 'false', 'msg' => "Token Expired"]);
    }
      } 
   
    
}
