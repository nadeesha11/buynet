@extends('layout.webLayout')
@section('content')
<main class="main">
    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="col-lg-5-5">
                <section class="home-slider position-relative mb-30">
                    <div class="home-slide-cover mt-30">
                        <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                             @foreach ($slider as $item)
                             <div class="single-hero-slider single-animation-wrap" style="background-image: url('{{ asset("assets/myCustomThings/mainBanner/".$item->name) }}') ">
                                <div class="slider-content">      
                                    <h1 class="display-2 mb-40">
                                        Don’t miss amazing<br />
                                        grocery deals
                                    </h1>
                                </div>
                            </div>   
                             @endforeach
                           
                        </div>
                        <div class="slider-arrow hero-slider-1-arrow"></div>
                    </div>
                </section>

                <div class="container mb-30">
                    <div class="row">
                        <div class="col-lg-4-5">
                            <div class="shop-product-fillter">
                                <div class="totall-product">
                                    <p>We found <strong class="text-brand">{{ $products->count() }}</strong> items for you!</p>
                                </div>
                            </div>
                            <div class="row product-grid">

                               @forelse ($products as $item)
                               <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-block">
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('web.product.detailed', ['id' => $item->id]) }}">
                                                <img height="150" class="default-img" src="{{ 'product_images/'.$item->image_name }}" alt="" />
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
                        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                            <div class="sidebar-widget widget-category-2 mb-30">
                                <h5 class="section-title style-1 mb-30">Category</h5>
                                <ul>
                                    @forelse ($categoryData as $item)
                                    <li>
                                        <a href="{{ route('web.category', ['id' => $item['id']]) }}"> <img src="assets/imgs/theme/icons/category-1.svg" alt="" />{{ $item['name'] }}</a><span style="color: green !important;">{{ $item['product_count'] }}</span>
                                    </li> 
                                    @empty
                                        <p>There is no category</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
             
            </div>
        </div>

        <section class="newsletter mb-15 wow animate__animated animate__fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="position-relative newsletter-inner">
                            <form action="{{ route('web.imageSearch') }}" method="POST"  enctype="multipart/form-data"> 
                             @csrf   
                            <div class="newsletter-content">
                                <h6 class="mb-20">
                                   You can search similer prodcut by image<br />
                                    
                                </h6>
                                <input  id="image_1" required data-allowed-file-extensions="jpeg jpg png"
                                            data-max-file-size-preview="1M" name="image" class="dropify"
                                type="file" >
                                <button class="submit submit-auto-width mt-3"  type="submit">Send message</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
  <!-- card end// -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
  integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
  integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    $('.dropify').dropify({
                        messages: {
                        'default': 'Drag and drop a image here or click',
                        'replace': 'Drag and drop or click to replace',
                        'remove': 'Remove',
                        'error': 'Ooops, something wrong happended.'
                            }
    });

    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('add_wishlist_success', () => {
            Swal.fire({
                title: 'Success!',
                text: 'product added to the wishlist.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });

        Livewire.on('add_wishlist_fail', () => {
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });

        Livewire.on('add_cart_success', () => {
            Swal.fire({
                title: 'Success!',
                text: 'Item added to the cart.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });

        Livewire.on('add_cart_fail', () => {
            Swal.fire({
                title: 'Error!',
                text: 'Item added to the cart.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });

        Livewire.on('product_already_exits', () => {
            Swal.fire({
                title: 'Error!',
                text: 'Product already exits.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });

        Livewire.on('product_already_in_wishlist', () => {
            Swal.fire({
                title: 'Error!',
                text: 'Product already exits in wishlist.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });
</script>
@endsection