<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminManagementController extends Controller
{
    public function index(){
        
        return view("Admin.adminManagement");
    }
    
    public function create(Request $request)
    {
    $request->validate([
      'name' => "required|max:100|unique:users|min:6",
      'email' => "required|max:100|unique:users|email",
      'password' => 'required|min:6|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
      'password_confirmation' => 'required|min:6',
      
    ]);
   try {
    $result = DB::table('users')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'created_at' => Carbon::now(),
        'status' => 1,
        'password' => Hash::make($request->password),
        'user_type' =>  1
      ]);
  
      if ($result) {
        return response()->json(['code' => 'true', 'msg' => "Admin Created"]);
      } else {
        return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
      }
   } catch (\Throwable $th) {
        return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
   }
  
    }
    
    public function recieveData(){
        $data = DB::table('users')
        ->whereIn('user_type', [1, 2]) 
        ->orderBy('id', 'asc')
        ->get();
    
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="edit btn btn-success btn-sm m-1"><i class="bi bi-x-lg"></i>Edit</a>';
                return $btn;
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    $status = '<span class="badge badge-pill badge-soft-success">Active</span>';
                } else {
                    $status = ' <span class="badge badge-pill badge-soft-danger">Deactive</span>';
                }
                return $status;
            })
            ->addColumn('position', function ($data) {
                if ($data->user_type == 2) {
                    $status = '<span class="badge badge-pill badge-soft-success">Super Admin</span>';
                } else {
                    $status = ' <span class="badge badge-pill badge-soft-danger">Admin</span>';
                }
                return $status;
            })
            ->rawColumns(['action', 'status','position'])
            ->make(true); 
    }
    
    public function getData($id){
        
      return DB::table('users')->find($id);  
    }
    
     public function update(Request $request){
        try {
            if ($request->status) {
                $status = 1;
        } else {
                $status = 0;
        }
    
        $result = DB::table('users')->where('id', $request->id)->update([
                'status' => $status,
        ]);
            
        if ($result) {
        return response()->json(['code' => 'true', 'msg' => "Admin status changed"]);
         } else {
        return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
        }
        } catch (\Throwable $th) {
            return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
        }
        
       
    }
}
