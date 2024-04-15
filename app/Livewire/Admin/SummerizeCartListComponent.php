<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SummerizeCartListComponent extends Component
{
    public $cartItems;
    public function mount(){
    $this->getData();
   
    }

    public function getData(){

       $customerData = session()->get('customer_data');

        $cartItems = DB::table('cart')
        ->join('product', 'cart.pro_id', '=', 'product.id')
        ->join(DB::raw('(SELECT product_id, MIN(name) AS name FROM product_images GROUP BY product_id) AS pi'), function($join) {
            $join->on('product.id', '=', 'pi.product_id');
        })
        ->select('cart.*', 'product.product_title', 'pi.name as image_name')
        ->where('cart.user_id', $customerData->id ?? 100000)
        ->get();
        
        $this->cartItems = $cartItems;
      
    }

    public function render()
    {
        return view('livewire.admin.summerize-cart-list-component');
    }

    protected $listeners = [
        'add_cart_success' => 'getData', 
        'update_cart_success' => 'getData', 
    ];
}
