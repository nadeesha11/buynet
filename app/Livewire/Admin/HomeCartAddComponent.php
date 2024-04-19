<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HomeCartAddComponent extends Component
{
    public $pro_id;

    public function add_to_cart($pro_id){
      try {
        $customerData = session()->get('customer_data');
        if($customerData){
          $pro_price = DB::table('product')->where('id',$pro_id)->pluck('product_price')->first();
        
          $check_product_existency = DB::table('cart')->where('user_id',$customerData->id)->where('pro_id',$pro_id)->first();
          if($check_product_existency){
              $this->dispatch('product_already_exits');
              return redirect()->back();
          }
          $result = DB::table('cart')->insert([
          'qty' => 1,
          'total' => $pro_price,
          'pro_id' => $pro_id,
          'user_id' => $customerData->id,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
          'coupon_status' => 0,
          ]);
          if($result){
          $this->dispatch('add_cart_success');
          return redirect()->back();
         
          }else{
          $this->dispatch('add_cart_fail');
          return redirect()->back();
         
          }
        }
        else{
          return redirect()->route('web.login');
        }
        
        
      } catch (\Throwable $th) {
        $this->dispatch('add_cart_fail');
        return redirect()->back();
       
      }
    }

    public function mount($pro_id)
    {
        $this->pro_id =$pro_id;
    }

    public function render()
    {
        return view('livewire.admin.home-cart-add-component');
    }
}
