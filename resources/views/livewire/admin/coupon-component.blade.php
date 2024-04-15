<div class="row mt-50">
    <div class="col-lg-8">
        <div class="p-40">
            <h4 class="mb-10">Apply Coupon</h4>
            <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</p>
            <form wire:submit="applyCoupon">
                <div class="d-flex justify-content-between">
                    <input class="font-medium mr-15 coupon" type="text" wire:model="coupon" placeholder="Enter Your Coupon">
                   
                    <button type="submit"  class="btn"><i class="fi-rs-label mr-10"></i>Apply</button>
                </div>
                @error('coupon') <span class="error text-danger">{{ $message }}</span> @enderror 
            </form>
        </div>
    </div>
</div>
