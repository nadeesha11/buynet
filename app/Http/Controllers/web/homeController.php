<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index(){
        $products = DB::table('product')
        ->join('category', 'product.cat_id', '=', 'category.id')
        ->join(DB::raw('(SELECT product_id, MIN(name) AS name FROM product_images GROUP BY product_id) AS pi'), function($join) {
            $join->on('product.id', '=', 'pi.product_id');
        })
        ->select('product.*', 'pi.name as image_name','category.name')
        ->where('product.status',1)
        ->get();
       
        // Fetch all categories with status 1
        $categories = DB::table('category')
        ->where('status', 1)
        ->get();

        $categoryData = [];

        // Loop through each category to get the product count and add to array
        foreach ($categories as $category) {
        $productCount = DB::table('product')
            ->where('cat_id', $category->id)
            ->count();

        // Create an array containing category data and product count
        $categoryArray = [
        'id' => $category->id,
        'name' => $category->name,
        'product_count' => $productCount,
        // Add more fields as needed
        ];

        // Push the category array to the main data array
        $categoryData[] = $categoryArray;
        }

        //get slider data
        $slider = DB::table('slide')->get();

        return view('web.home',compact('products','categoryData','slider'));
    }

    public function viewWishlist(){
        return view('web.detailed_wishlist');
    }

    public function detailedCart(){
        return view('web.detailed_cart');
    }

  
}
