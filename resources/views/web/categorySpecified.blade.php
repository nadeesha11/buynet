@extends('layout.webLayout')
@section('content')
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span>  Category
            </div>
        </div>
    </div>
    <div class="page-content ">
        <div class="container mb-30">
            <div class="row mt-3">
                <div class="col-lg-4-5">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>We found <strong class="text-brand">{{ $products->count() }}</strong> items !</p>
                        </div>
                    </div>
                    <div class="row product-grid">
                       @forelse ($products as $item)
                       <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-block">
                        <div class="product-cart-wrap">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('web.product.detailed', ['id' => $item->id]) }}">
                                        <img height="150" class="default-img" src="{{ asset('product_images/' . $item->image_name) }}" alt="" />
                                    </a>
                                </div>
                               @livewire('Admin.AddTowishListComponent', ['productId' => $item->id])
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="#">{{ $item->name }}</a>
                                </div>
                                <h2><a href="#">{{ $item->product_title }}</a></h2>
                               
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>Rs. {{ $item->product_price }}</span>
                                    </div>
                                </div>
                                @livewire('Admin.homeCartAddComponent', ['pro_id' => $item->id])
                            </div>
                        </div>
                    </div>
                    <!--end product card--> 
                       @empty
                         <p>There is no products at this moment</p>  
                       @endforelse
                    </div>
                    <!--product grid-->
            
                </div>
                
            </div>
        </div>
    </div>
</main>
@endsection











