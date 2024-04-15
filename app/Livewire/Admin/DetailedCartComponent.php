<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetailedCartComponent extends Component
{
    public $cartItems;

    protected $listeners = [
        'coupon_applied_success' => 'getData', 
      ];

    public function mount(){
     $this->getData();
    }

    public function add_cart_qty_up($id){
        try {
           
    $cart_item_data = DB::table('cart')->find($id);
    $product_price = DB::table('product')->find($cart_item_data->pro_id);

    $updateData = [];

    $updateData['total'] = DB::raw('total + ' . $product_price->product_price);
    $updateData['qty'] = DB::raw('qty + 1');
    
    
    DB::table('cart')->where('id', $id)->update($updateData);
       
    $this->dispatch('update_cart_success');
    $this->getData();
    // return redirect()->back();
        } catch (\Throwable $th) {
            $this->dispatch('update_cart_fail');
        }
    
    }

    public function add_cart_qty_down($id){
    try {
           
    $cart_item_data = DB::table('cart')->find($id);
    $this->checkQty($cart_item_data->qty);

    $product_price = DB::table('product')->find($cart_item_data->pro_id);
    
    $updateData = [];

    $updateData['total'] = DB::raw('total - ' . $product_price->product_price);
    $updateData['qty'] = DB::raw('qty - 1');
    
    
    DB::table('cart')->where('id', $id)->update($updateData);
       
    $this->dispatch('update_cart_success');
    $this->getData();
    // return redirect()->back();
        } catch (\Throwable $th) {
            $this->dispatch('update_cart_fail');
        }
    
    }

    public function deleteCartItem($id){
        try {
           $success = DB::table('cart')->delete($id);
           if($success){
            $this->getData();
            $this->dispatch('trash_cart_success');
           }else{
            $this->dispatch('trash_cart_failed');
           }
           
        } catch (\Throwable $th) {
            $this->dispatch('trash_cart_failed');
        }
    
    }

    protected function checkQty($qty){
     if($qty == 1){
        throw new \Exception("Quantity is already at minimum.");
     }
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
        return view('livewire.admin.detailed-cart-component');
    }
}
