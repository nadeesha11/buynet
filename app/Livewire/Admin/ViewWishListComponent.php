<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ViewWishListComponent extends Component
{
    public $wishlist;

    public function mount()
    {
    $this->getData();
    }

    public function getData(){
        $customerData = session()->get('customer_data');

        $wishlist = DB::table('wishlist')
        ->join('product', 'wishlist.pro_id', '=', 'product.id')
        ->join('users', 'wishlist.user_id', '=', 'users.id')
        ->join(DB::raw('(SELECT product_id, MIN(name) AS name FROM product_images GROUP BY product_id) AS pi'), function($join) {
            $join->on('product.id', '=', 'pi.product_id');
        })
        ->select('wishlist.*', 'product.product_title', 'pi.name as image_name')
        ->where('wishlist.user_id', $customerData->id ?? 1000000)
        ->get();
        
        $this->wishlist = $wishlist;
    }

    public function deleteWishlist($id){
        try {
           $success = DB::table('wishlist')->delete($id);
           if($success){
            $this->getData();
            $this->dispatch('trash_wishlist_success');
           }else{
            $this->dispatch('trash_wishlist_failed');
           }
           
        } catch (\Throwable $th) {
            $this->dispatch('trash_wishlist_failed');
        }
    
    }

    public function add_to_cart($pro_id,$id){
        try {
            $customerData = session()->get('customer_data');
            if($customerData){
              $pro_price = DB::table('product')->where('id',$pro_id)->pluck('product_price')->first();
            
              $check_product_existency = DB::table('cart')->where('user_id',$customerData->id)->where('pro_id',$pro_id)->first();
              if($check_product_existency){
               
                  $this->dispatch('product_already_exits_in_cart');
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
              $this->dispatch('add_wishlist_to_cart_success');
              //delete wish list
              DB::table('wishlist')->where('id',$id)->delete();

              }else{
              $this->dispatch('add_cart_fail');
              }
            }
            else{
              return redirect()->route('web.login');
            }
            
            
          } catch (\Throwable $th) {
           
            $this->dispatch('add_cart_fail');
           
          }
    }

    public function render()
    {
        $this->getData();
        return view('livewire.admin.view-wish-list-component');
    }
}
