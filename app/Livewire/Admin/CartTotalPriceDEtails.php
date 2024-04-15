<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CartTotalPriceDEtails extends Component
{
    public $final_price; 

    public function finalPrice(){
        $customerData = session()->get('customer_data');
        $final_price = DB::table('cart')->where('user_id',$customerData->id)->sum('total');
        $this->final_price = $final_price;
    }
    public function render()
    {
        $this->finalPrice();
        return view('livewire.admin.cart-total-price-d-etails');
    }

    protected $listeners = [
        'add_cart_success' => 'finalPrice', 
        'update_cart_success' => 'finalPrice', 
        'trash_cart_success' => 'finalPrice',
    ];
}
