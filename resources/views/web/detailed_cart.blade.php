@extends('web.cart_detailed')
@section('content')
<style>
    .detail-extralink .detail-qty{
        max-width:70px !important;
    }
</style>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                
                <span></span> Cart
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">Your Cart</h1>
               
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th scope="col" colspan="2">Product</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col" class="end">Remove</th>
                            </tr>
                        </thead>
                      
                            @livewire('Admin.DetailedCartComponent')
                           
                        
                    </table>
                </div>
                <div class="divider-2 mb-30"></div>
               
               @livewire('Admin.CouponComponent')
            </div>
            <div class="col-lg-4">
                <div class="border p-md-4 cart-totals ml-30">
                    <div class="table-responsive">
                        <table class="table no-border">
                           @livewire('Admin.CartTotalPriceDEtails')
                        </table>
                    </div>
                    <a href="{{ route('web.displayCheckout') }}" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('coupon_applied_success', () => {
            Swal.fire({
                title: 'Success!',
                text: 'coupon applied success.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });

    });
</script>
@endsection