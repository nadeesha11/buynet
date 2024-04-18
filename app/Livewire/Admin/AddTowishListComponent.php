<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddTowishListComponent extends Component
{
    public $productId;

    public function mount($productId)
    {
       
        $this->productId = $productId;

    }
    public function addToWishlist()
    {
        if(session()->has('customer_data')) {
            $customerData = session()->get('customer_data');

            try {
                $check_wishlist_exits = DB::table('wishlist')->where('pro_id',$this->productId)->where('user_id',$customerData->id)->first();
                if($check_wishlist_exits){
                    $this->dispatch('product_already_in_wishlist');
                    return redirect()->back();
                }else{
                    $result = DB::table('wishlist')->insert([
                        'pro_id' => $this->productId,
                        'user_id' => $customerData->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                   
                    ]);
                }
               
                if($result){
                 
                    $this->dispatch('add_wishlist_success');
                    return redirect()->back();
                }
                else{
                 
                    $this->dispatch('add_wishlist_fail');
                    return redirect()->back();
                }
              
            } catch (\Throwable $th) {
                $this->dispatch('add_wishlist_fail');
                return redirect()->back();
            }

        } else {
            redirect()->route('web.login');
        }
    }
    public function render()
    {
        return view('livewire.admin.add-towish-list-component');
    }
}
