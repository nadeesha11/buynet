<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function register(){
        return view('web.register');
    }

    public function create(Request $request){
        $request->validate([
            'username' => 'required|min:8|unique:users,name',
            'email' => 'required|email|email|unique:users,email',
            'password' => 'required', 'confirmed', 'max:20', 'min:6',
        ]);

        try {
            $result = DB::table('users')->insertGetId([
                'name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'status' => 1,
                'user_type' => 5,
            ]);
    
            if ($result) {
                $customer_data = DB::table('users')->find($result);
                session(['customer_data' => $customer_data]);
                return response()->json(['code' => 'true', 'msg' => "register successfully"]);
            } else {
                return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
            }
        } catch (\Throwable $th) {
            return response()->json(['code' => 'false', 'msg' => $th->getMessage()]);
        }
    }

    public function login(){
        return view('web.login');
    }

    public function authCheck(Request $request){

        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $customer_data = DB::table('users')->where('name', $request->name)->where('user_type', 5)->first();
            session(['customer_data' => $customer_data]);
            // check remember me token clicked or not start
            if (isset($request->checkbox)) {

                Cookie::queue('buynet_customer_username', $request->name, 1440);
                Cookie::queue('buynet_customer_password', $request->password, 1440);
            } else {
                Cookie::queue(Cookie::forget('buynet_customer_username'));
                Cookie::queue(Cookie::forget('buynet_customer_password'));
            }
            
            return response()->json(['code' => 'true', 'msg' => "Login Success"]);
        } else {
            return response()->json(['code' => 'false', 'msg' => "The username and password do not match."]);
        }
    }

    public function dashboard(){

        $customerData = session()->get('customer_data');

        $data = DB::table('orders')
        ->where('orders.user_id', $customerData->id)
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.*')
        ->orderByDesc('orders.id') 
        ->get();

        return view('web.dashboard',compact('data','customerData'));
    }

    public function logout(){
        Auth::logout();
        session()->flush();
        return redirect()->route('web.logout');
    }
}
