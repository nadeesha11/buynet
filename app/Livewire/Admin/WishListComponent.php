<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class WishListComponent extends Component
{
    public $wishlistCount = 0;
    protected $listeners = ['add_wishlist_success' => 'updateWishlistCount'];

    public function mount()
    {
        $this->updateWishlistCount();
    }

    public function updateWishlistCount()
    {
        $this->wishlistCount = DB::table('wishlist')->count();
    }

    public function render()
    {
        return view('livewire.admin.wish-list-component');
    }
}
