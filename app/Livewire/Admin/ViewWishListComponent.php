<?php

namespace App\Livewire\Admin;

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

    public function render()
    {
        return view('livewire.admin.view-wish-list-component');
    }
}
