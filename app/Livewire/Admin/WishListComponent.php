<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class WishListComponent extends Component
{
    public $wishlistCount = 0;
    protected $listeners = ['add_wishlist_success' => 'updateWishlistCount','add_wishlist_to_cart_success' => 'updateWishlistCount'];

    public function mount()
    {
        $this->updateWishlistCount();
    }

    public function updateWishlistCount()
    {
        $customerData = session()->get('customer_data');
        if($customerData){
            $this->wishlistCount = DB::table('wishlist')->count();
        }
       
    }

    public function render()
    {
        return view('livewire.admin.wish-list-component');
    }
}
