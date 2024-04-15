<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class slideManagmentController extends Controller
{
    public function index(){
        return view('admin.slideManagement');
    }

    public function recieveData(){
        $data =  DB::table('slide')->orderBy('id', 'asc')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="delete btn btn-danger btn-sm m-1"><i class="bi bi-x-lg"></i>Delete</a>';
                return $btn;
            })
            ->addColumn('image', function ($data) {
                $url = asset("assets/myCustomThings/mainBanner/$data->name");
                return '<img style="  width:155px !important; height:155px !important; object-fit:contain !important;" src=' . $url . ' border="0" width="40" class="img-rounded" align="center" />';
            })

            ->rawColumns(['action', 'image'])
            ->make(true);
    }

    public function create(Request $request){
        $request->validate([
            'slider' => 'required',
        ], [
            'slider.required' => 'The main banner field is required.',
        ]);
        
        try { 

            $slider_image = time() . rand(1, 100) . '.' . $request->slider->extension();
            $request->slider->move(public_path("assets/myCustomThings/mainBanner"), $slider_image); //rename image and upload

            $result = DB::table('slide')->insert([
                'name' => $slider_image,
            ]);

            if ($result) {
                return response()->json(['code' => 'success', 'msg' => 'banner added']);
            } else {
                return response()->json(['code' => 'error', 'msg' => 'something went wrong']);
            }
        } catch (Exception $e) {
            // Exception occurred, handle it here
            return response()->json(['code' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function delete($id){
        $banner = DB::table('slide')->where('id', $id)->first();
    
        if (!$banner) {
            return response()->json(['code' => 'error', 'msg' => 'Slider not found']);
        }
    
        $imageName = $banner->name;
    
        // Delete the record from the database
        $result = DB::table('slide')->where('id', $id)->delete();
    
        if ($result) {
            // Delete the associated image from local storage
            if (Storage::disk('public')->exists('assets/myCustomThings/mainBanner/' . $imageName)) {
                Storage::disk('public')->delete('assets/myCustomThings/mainBanner/' . $imageName);
            }
    
            return response()->json(['code' => 'success', 'msg' => 'Slider deleted']);
        } else {
            return response()->json(['code' => 'error', 'msg' => 'Something went wrong']);
        }
    }
}
