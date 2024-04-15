<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class subCategoryController extends Controller
{
    public function index($id){
        $data =  DB::table('sub_category')->where('cat_id',$id)->orderBy('id', 'asc')->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="edit btn btn-info btn-sm m-1"><i class="bi bi-x-lg"></i>Edit</a>';
            $btn = $btn. '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="access btn btn-success btn-sm m-1"><i class="bi bi-x-lg"></i>access product</a>';
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

    public function create(Request $request){
        $request->validate([
            'name' => 'required|unique:sub_category,name',
        ]);
        
        try { 
            $result = DB::table('sub_category')->insert([
                'name' => $request->name,
                'status' => 1,
                'cat_id' => $request->cat_id
            ]);

            if ($result) {
                return response()->json(['code' => 'success', 'msg' => 'sub category created']);
            } else {
                return response()->json(['code' => 'error', 'msg' => 'something went wrong']);
            }
        } catch (Exception $e) {
            // Exception occurred, handle it here
            return response()->json(['code' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function edit($id){
    $data = DB::table('sub_category')->find($id);
    return $data;
    }

    public function update(Request $request){
        $request->validate([
            'name' => [
                'required',
                'max:20',
                Rule::unique('sub_category')->ignore($request->id)
            ]
        ]);

       try {
        if (isset($request->categoryEdit)) { //check status active or not
            $status = 1;
        } else {
            $status = 0;
        }

        $result = DB::table('sub_category')->where('id', $request->id)->update([
            'name' => $request->name,
            'status' => $status,
        ]);

        if ($result) {
            return response()->json(['code' => 'true', 'msg' => "sub category Updated."]);
        } else {
            return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
        }
       } catch (\Throwable $th) {
             return response()->json(['code' => 'true', 'msg' => "Something went wrong."]);
       }
    }

    public function nextPage($id,$category_id){
     return view('admin.product',compact('id','category_id'));
    }
}
