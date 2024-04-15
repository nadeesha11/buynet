<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class productController extends Controller
{
    public function create(Request $request){
    $request->validate([
    'product_title' => 'required|max:200',
    'product_price' => 'required|numeric|min:0.01',
    'description' => 'required|max:1000',
    'image_1' => 'required|image',
    'image_2' => 'required|image',
    'image_3' => 'required|image',
    ]);

    try {
       DB::beginTransaction();

      $last_inserted_product_id = DB::table('product')->insertGetId([
      'product_title' => $request->product_title,
      'product_price' => $request->product_price,
      'description' => $request->description,
      'cat_id' => $request->cat_id,
      'sub_cat_id' => $request->sub_cat_id,
      'status' => 1,
      'created_at' => Carbon::now(),
      'updated_at' =>  Carbon::now(),
      ]);  
     
      $image_1 = time().rand(1,1000).'.'.$request->image_1->extension();
      $request->image_1->move(public_path('product_images'),$image_1);

      $image_2 = time().rand(1,1000).'.'.$request->image_2->extension();
      $request->image_2->move(public_path('product_images'),$image_2);

      $image_3 = time().rand(1,1000).'.'.$request->image_3->extension();
      $request->image_3->move(public_path('product_images'),$image_3);

      $images_data = [['product_id' => $last_inserted_product_id,
      'name' => $image_1,],
      ['product_id' => $last_inserted_product_id,
      'name' => $image_2,],
      ['product_id' => $last_inserted_product_id,
      'name' => $image_3,],
      ];
      DB::table('product_images')->insert($images_data);

      DB::commit();
      return response()->json(['code' => 'success', 'msg' => 'record added']);

    } catch (\Throwable $th) {
        DB::rollback();
        return response()->json(['code' => 'error', 'msg' => $th->getMessage()]);
    }
    }

    public function getData(){

        $data =  DB::table('product')
        ->orderBy('id', 'asc')->get();

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="edit btn btn-info btn-sm m-1"><i class="bi bi-x-lg"></i>Edit</a>';
                $btn = $btn. '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="info btn btn-success btn-sm m-1"><i class="bi bi-x-lg"></i>Info</a>';
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

    public function info($id){

       $data = DB::table('product')
       ->join('product_images', 'product.id', '=', 'product_images.product_id')
       ->where('product.id',$id)
       ->select('product.*', 'product_images.name')
       ->get();
       return $data;
    }

    public function update(Request $request){
    $request->validate([
    'product_title' => 'required|max:200',
    'product_price' => 'required|numeric|min:0.01',
    'description' => 'required|max:1000',

    'image_1' => 'image',
    'image_2' => 'image',
    'image_3' => 'image',
    ]);

    try {
        DB::beginTransaction();

        if (isset($request->productEdit)) { //check status active or not
            $status = 1;
        } else {
            $status = 0;
        }
 
        DB::table('product')->where('id',$request->id)->update([
       'product_title' => $request->product_title,
       'product_price' => $request->product_price,
       'description' => $request->description,
       'status' => $status,
       'updated_at' =>  Carbon::now(),
       ]); 
       
       if($request->image_1){
        //get and remove first image

        $data = DB::table('product_images')->where('product_id',$request->id)->get();
        $data[0]->name;

        $imagePath = public_path('product_images/' . $data[0]->name);

        if(File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $image_1 = time().rand(1,1000).'.'.$request->image_1->extension();
        $request->image_1->move(public_path('product_images'),$image_1);
       
        DB::table('product_images')->where('name',$data[0]->name)->update([
        'name' =>  $image_1
        ]);
       }

       if($request->image_2){
        $data = DB::table('product_images')->where('product_id',$request->id)->get();
        $data[1]->name;

        $imagePath = public_path('product_images/' . $data[1]->name);

        if(File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $image_2 = time().rand(1,1000).'.'.$request->image_2->extension();
        $request->image_2->move(public_path('product_images'),$image_2);
       
        DB::table('product_images')->where('name',$data[1]->name)->update([
        'name' =>  $image_2
        ]);
       }

       if($request->image_3){
        $data = DB::table('product_images')->where('product_id',$request->id)->get();
        $data[2]->name;

        $imagePath = public_path('product_images/' . $data[2]->name);

        if(File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $image_3 = time().rand(1,1000).'.'.$request->image_3->extension();
        $request->image_3->move(public_path('product_images'),$image_3);
       
        DB::table('product_images')->where('name',$data[2]->name)->update([
        'name' =>  $image_3
        ]);
       }
      
       DB::commit();
       return response()->json(['code' => 'success', 'msg' => 'record updated']);
 
     } catch (\Throwable $th) {
         DB::rollback();
         return response()->json(['code' => 'error', 'msg' => $th->getMessage()]);
     }

    }

   
}
