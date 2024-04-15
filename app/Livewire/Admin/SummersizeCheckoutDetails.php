<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SummersizeCheckoutDetails extends Component
{
    public $final_price;
    public $cartItems;

    public function finalPrice(){
        $customerData = session()->get('customer_data');
        $final_price = DB::table('cart')->where('user_id',$customerData->id)->sum('total');
        $this->final_price = $final_price;
    }

    public function getData(){

        $customerData = session()->get('customer_data');
 
         $cartItems = DB::table('cart')
         ->join('product', 'cart.pro_id', '=', 'product.id')
         ->join(DB::raw('(SELECT product_id, MIN(name) AS name FROM product_images GROUP BY product_id) AS pi'), function($join) {
             $join->on('product.id', '=', 'pi.product_id');
         })
         ->select('cart.*', 'product.product_title', 'pi.name as image_name','product.product_price',)
         ->where('cart.user_id', $customerData->id ?? 100000)
         ->get();
         
         $this->cartItems = $cartItems;
       
     }

    public function render()
    {
        $this->getData();
        $this->finalPrice();
        return view('livewire.admin.summersize-checkout-details');
    }
}
