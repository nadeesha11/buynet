<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reviewController extends Controller
{
    public function index(){
        return view('admin.reviewManagement');
    }

    public function recieveData(){
        $data =  DB::table('review')
        ->join('product', 'review.product_id', '=', 'product.id')
        ->select('review.*','product.product_title')
        ->get();

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
    $data = DB::table('review')->find($id);
    return $data;
    } 

    public function update(Request $request){
        try {
            if (isset($request->reviewEdit)) { //check status active or not
                $status = 1;
            } else {
                $status = 0;
            }
    
            $result = DB::table('review')->where('id', $request->id)->update([
            
                'status' => $status,
            ]);
    
            if ($result) {
                return response()->json(['code' => 'true', 'msg' => "Review Approved."]);
            } else {
                return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
            }
           } catch (\Throwable $th) {
                 return response()->json(['code' => 'true', 'msg' => "Something went wrong."]);
           }
    }
}
