<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class orderManagement extends Controller
{
    public function index(){
        return view('admin.orderManagement');
    }

    public function recieveData(){
        $data =  DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.*')
        ->get();

        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="edit btn btn-danger btn-sm m-1"><i class="bi bi-x-lg"></i>Edit</a>';
            $btn = $btn. '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="info btn btn-info btn-sm m-1"><i class="bi bi-x-lg"></i>Info</a>';
            return $btn;
        })
        ->addColumn('status', function ($data) {
            if ($data->status == 0) {
                $status = '<span class="badge badge-pill badge-soft-success">Order Placed</span>';
            } else if($data->status == 1) {
                $status = ' <span class="badge badge-pill badge-soft-danger">Order Packed</span>';
            }
            else if($data->status == 2) {
                $status = ' <span class="badge badge-pill badge-soft-danger">Order Shipped</span>';
            }
            else if($data->status == 3) {
                $status = ' <span class="badge badge-pill badge-soft-danger">Order Deliverd</span>';
            }
            return $status;
        })
        ->rawColumns(['action','status'])
        ->make(true);
    }

    public function info($id){
        $order = DB::table('orders')->find($id);
        $order_list =  DB::table('order_list')
        ->join('product', 'order_list.product_id', '=', 'product.id')
        ->select('order_list.*','product.product_title','product.product_price',)
        ->where('order_id',$id)->get();

        return view('admin.orderInfo',compact('order_list','order'));
    }

    public function edit($id){
        $order = DB::table('orders')->find($id);
        return $order;
    }

    public function update(Request $request){
       try {
        DB::table('orders')->where('id',$request->id)->update([
        'status' => $request->status,
        ]);
        return  redirect()->back();
       } catch (\Throwable $th) {
        return redirect()->back();
       }
    }
}
