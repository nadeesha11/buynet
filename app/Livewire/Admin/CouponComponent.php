<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Validate; 
use Illuminate\Support\Facades\Validator;

class CouponComponent extends Component
{
    #[Validate('required')] 
    public $coupon;

    public function applyCoupon(){
    $this->validate(); 
    try {
        //need to check it is validate and active coupon
    $check_coupon = DB::table('coupon')->where('coupon',$this->coupon)->where('status',1)->first();
    if ($check_coupon) {
        $expiry_date = $check_coupon->expire_date; 
        $current_date = Carbon::now(); 
    
        if ($expiry_date > $current_date) {// coupon ready to deploy
            //get product id that relavent to coupon code
            $couponData = DB::table('coupon')->where('coupon',$this->coupon)->first();

            $customerData = session()->get('customer_data');
            $checkRelevantProduct = DB::table('cart')->where('user_id',$customerData->id)->where('pro_id',$couponData->product_id)->where('coupon_status',0)->first();

            if($checkRelevantProduct){
                // Calculate the discount amount
                $discountAmount = ($couponData->discount / 100) * $checkRelevantProduct->total;

                // Apply discount to the total price
                $discountedPrice = $checkRelevantProduct->total - $discountAmount;
                   
                try {
                    DB::transaction(function () use ($checkRelevantProduct, $discountedPrice, $couponData) {
                        // Update the cart total and set coupon status to 1
                        DB::table('cart')->where('id', $checkRelevantProduct->id)->update([
                            'total' => $discountedPrice,
                            'coupon_status' => 1,
                        ]);

                        // Deactivate the relevant coupon
                        DB::table('coupon')->where('id', $couponData->id)->update([
                            'status' => 0,
                        ]);
                    });

                    $this->dispatch('coupon_applied_success');
                    $this->reset();
                    $this->resetValidation();
                    // return redirect()->back();
                } catch (\Exception $e) {
                    $this->addError('coupon', 'something went wrong , please try again');
                    return;
                }

            }
            else{
                $this->addError('coupon', 'Coupon not relavent to your current cart items or you already used coupon on them');
                return;
            }
            
        } else {
            $this->addError('coupon', 'Coupon is expired');
            return;
        }
    } else {
        $this->addError('coupon', 'Coupon not found or inactive');
            return;
    }
    } catch (\Throwable $th) {
        $this->addError('coupon', $th->getMessage());
            return;
    }
    

    //is it expired or not
    //check that cart product match with coupn
    //applied precentage with exsisting price
    //chnage status of cart and coupon status

    
    }
    public function render()
    {
        return view('livewire.admin.coupon-component');
    }
}
