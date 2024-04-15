<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class couponController extends Controller
{
    public function index(){
        $data = DB::table('product')->get();
        return view('admin.couponManagement',compact('data'));
    }

    public function create(Request $request){
       $request->validate([
      'coupon_count' => 'required|integer',
      'expire_date' => 'required|date',
      'discount_rate' => 'required|numeric|min:0|max:100',
      'product' => 'required'
       ]);

       try {
        DB::beginTransaction();
        for ($i = 0; $i < $request->coupon_count; $i++) {
            DB::table('coupon')->insert([
                'coupon' => Str::random(10),
                'expire_date' => $request->expire_date,
                'discount' => $request->discount_rate,
                'product_id' => $request->product,
                'status' => 1,
            ]);
        }
        DB::commit();
        return response()->json(['code' => 'success', 'msg' => 'record added']);

       } catch (\Throwable $th) {
        DB::rollback();
        return response()->json(['code' => 'error', 'msg' => $th->getMessage()]);
       }

    }

    public function recieveData(){
        $data =  DB::table('coupon')
        ->join('product', 'coupon.id', '=', 'product.sub_cat_id')
        ->select('coupon.*','product.product_title')
        ->orderBy('coupon.id', 'asc')->get();

        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="edit btn btn-info btn-sm m-1"><i class="bi bi-x-lg"></i>Edit</a>';
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
        ->rawColumns(['action','status'])
        ->make(true);
    }

    public function edit($id){
    $data = DB::table('coupon')->find($id);
    return $data;
    }

    public function update(Request $request){
    
        $request->validate([
        'discount' => 'required|numeric|min:0|max:100',
        ]);

        try {

            if (isset($request->status)) { //check status active or not
                $status = 1;
            } else {
                $status = 0;
            }

            $result = DB::table('coupon')->where('id',$request->id)->update([
            'discount' => $request->discount,
            'status' => $status,
            ]);

        } catch (\Throwable $th) {
            return response()->json(['code' => 'error', 'msg' => $th->getMessage()]);
        }
    }
}
