<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>BuyNet</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('web/assets/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/assets/css/plugins/slider-range.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/assets/css/main.css?v=5.3') }}" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Vendor JS-->
    <script src="{{ asset('web/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/slider-range.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <style>
        .search-style-2 form input{
            background-image: none !important;
        }
    </style>
    <header class="header-area header-style-1 header-height-2">
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="{{ route('web.home') }}"><img style="width: 60px !important; min-width:60px !important;" src="https://i.ibb.co/9y2DqZp/299799450-443349117812853-1057684977558847665-n-1.png" alt="logo" /></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form id="voiceSearch_form" method="POST" action="{{ route('web.voiceSearch') }}">
                                @csrf
                                <input type="text"  name="keyword" placeholder="Search for items..." />
                                <a href="#"><i style="font-size: 20px !important; " class="fa fa-microphone m-2 microphone" aria-hidden="true"></i></a> 
                            </form>
                           
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="search-location">
                                    <form action="#">
                                        <select class="select-active">
                                            <option>Your Location</option>
                                            <option>Alabama</option>
                                            <option>Alaska</option>
                                            <option>Arizona</option>
                                            <option>Delaware</option>
                                            <option>Florida</option>
                                            <option>Georgia</option>
                                            <option>Hawaii</option>
                                            <option>Indiana</option>
                                            <option>Maryland</option>
                                            <option>Nevada</option>
                                            <option>New Jersey</option>
                                            <option>New Mexico</option>
                                            <option>New York</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="header-action-icon-2">
                                    <form method="POST" action="{{ route('web.voice_command') }}" id="voice_command_form">
                                        @csrf
                                        <input type="hidden"  name="voice"  />
                                        <a href="#"><i style="font-size: 20px !important; " class="fa fa-microphone m-2 voiceCommand" aria-hidden="true"></i></a> 
                                    </form>
                                </div>
                               @livewire('admin.wish-list-component')
                               @livewire('admin.summerize-cart-list-component')
                              
                                <div class="header-action-icon-2">
                                    <a href="#">
                                        <img class="svgInject" alt="Nest" src="{{ asset('web/assets/imgs/theme/icons/icon-user.svg') }}" />
                                    </a>
          
                                    @if(session('customer_data'))
                                    <a href="#"><span class="lable ml-0">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li><a href="{{ route('web.dashboard') }}"><i class="fi fi-rs-user mr-10"></i>My Account</a></li>
                                            <li><a href="page-login.html"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a></li>
                                        </ul>
                                    </div>
                                    
                                    @else
                                    <a href="{{ route('web.login') }}"><span class="lable ml-0">Login</span></a>
                                   
                                    @endif
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="index.html"><img src="assets/imgs/theme/logo.svg" alt="logo" /></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                            <nav>
                                <ul>
                                    <li>
                                        <a class="active" href="{{ route('web.home') }}">Home </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('web.product.all') }}">Product</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('web.contact') }}">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-flex">
                        <img src="{{ asset('web/assets/imgs/theme/icons/icon-headphone.svg') }}" alt="hotline" />
                        <p>0713439884<span>24/7 Support Center</span></p>
                    </div>
                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="shop-wishlist.html">
                                    <img alt="Nest" src="assets/imgs/theme/icons/icon-heart.svg" />
                                    <span class="pro-count white">4</span>
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="shop-cart.html">
                                    <img alt="Nest" src="assets/imgs/theme/icons/icon-cart.svg" />
                                    <span class="pro-count white">2</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="shop-product-right.html"><img alt="Nest" src="assets/imgs/shop/thumbnail-3.jpg" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="shop-product-right.html">Plain Striola Shirts</a></h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="shop-product-right.html"><img alt="Nest" src="assets/imgs/shop/thumbnail-4.jpg" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="shop-product-right.html">Macbook Pro 2022</a></h4>
                                                <h3><span>1 × </span>$3500.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$383.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="shop-cart.html">View cart</a>
                                            <a href="shop-checkout.html">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html"><img src="assets/imgs/theme/logo.svg" alt="logo" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Search for items…" />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <li class="menu-item-has-children">
                                <a href="index.html">Home</a>
                                <ul class="dropdown">
                                    <li><a href="index.html">Home 1</a></li>
                                    <li><a href="index-2.html">Home 2</a></li>
                                    <li><a href="index-3.html">Home 3</a></li>
                                    <li><a href="index-4.html">Home 4</a></li>
                                    <li><a href="index-5.html">Home 5</a></li>
                                    <li><a href="index-6.html">Home 6</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="shop-grid-right.html">shop</a>
                                <ul class="dropdown">
                                    <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                                    <li><a href="shop-grid-left.html">Shop Grid – Left Sidebar</a></li>
                                    <li><a href="shop-list-right.html">Shop List – Right Sidebar</a></li>
                                    <li><a href="shop-list-left.html">Shop List – Left Sidebar</a></li>
                                    <li><a href="shop-fullwidth.html">Shop - Wide</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Single Product</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Product – Right Sidebar</a></li>
                                            <li><a href="shop-product-left.html">Product – Left Sidebar</a></li>
                                            <li><a href="shop-product-full.html">Product – No sidebar</a></li>
                                            <li><a href="shop-product-vendor.html">Product – Vendor Infor</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="shop-filter.html">Shop – Filter</a></li>
                                    <li><a href="shop-wishlist.html">Shop – Wishlist</a></li>
                                    <li><a href="shop-cart.html">Shop – Cart</a></li>
                                    <li><a href="shop-checkout.html">Shop – Checkout</a></li>
                                    <li><a href="shop-compare.html">Shop – Compare</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Shop Invoice</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-invoice-1.html">Shop Invoice 1</a></li>
                                            <li><a href="shop-invoice-2.html">Shop Invoice 2</a></li>
                                            <li><a href="shop-invoice-3.html">Shop Invoice 3</a></li>
                                            <li><a href="shop-invoice-4.html">Shop Invoice 4</a></li>
                                            <li><a href="shop-invoice-5.html">Shop Invoice 5</a></li>
                                            <li><a href="shop-invoice-6.html">Shop Invoice 6</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Vendors</a>
                                <ul class="dropdown">
                                    <li><a href="vendors-grid.html">Vendors Grid</a></li>
                                    <li><a href="vendors-list.html">Vendors List</a></li>
                                    <li><a href="vendor-details-1.html">Vendor Details 01</a></li>
                                    <li><a href="vendor-details-2.html">Vendor Details 02</a></li>
                                    <li><a href="vendor-dashboard.html">Vendor Dashboard</a></li>
                                    <li><a href="vendor-guide.html">Vendor Guide</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Mega menu</a>
                                <ul class="dropdown">
                                    <li class="menu-item-has-children">
                                        <a href="#">Women's Fashion</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Dresses</a></li>
                                            <li><a href="shop-product-right.html">Blouses & Shirts</a></li>
                                            <li><a href="shop-product-right.html">Hoodies & Sweatshirts</a></li>
                                            <li><a href="shop-product-right.html">Women's Sets</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Men's Fashion</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Jackets</a></li>
                                            <li><a href="shop-product-right.html">Casual Faux Leather</a></li>
                                            <li><a href="shop-product-right.html">Genuine Leather</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Technology</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Gaming Laptops</a></li>
                                            <li><a href="shop-product-right.html">Ultraslim Laptops</a></li>
                                            <li><a href="shop-product-right.html">Tablets</a></li>
                                            <li><a href="shop-product-right.html">Laptop Accessories</a></li>
                                            <li><a href="shop-product-right.html">Tablet Accessories</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="blog-category-fullwidth.html">Blog</a>
                                <ul class="dropdown">
                                    <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                    <li><a href="blog-category-list.html">Blog Category List</a></li>
                                    <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                    <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Single Product Layout</a>
                                        <ul class="dropdown">
                                            <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                            <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                            <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="page-about.html">About Us</a></li>
                                    <li><a href="page-contact.html">Contact</a></li>
                                    <li><a href="page-account.html">My Account</a></li>
                                    <li><a href="page-login.html">Login</a></li>
                                    <li><a href="page-register.html">Register</a></li>
                                    <li><a href="page-forgot-password.html">Forgot password</a></li>
                                    <li><a href="page-reset-password.html">Reset password</a></li>
                                    <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                    <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                    <li><a href="page-terms.html">Terms of Service</a></li>
                                    <li><a href="page-404.html">404 Page</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Language</a>
                                <ul class="dropdown">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li>
                                    <li><a href="#">Spanish</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap">
                    <div class="single-mobile-header-info">
                        <a href="page-contact.html"><i class="fi-rs-marker"></i> Our location </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="page-login.html"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                    </div>
                </div>
                <div class="mobile-social-icon mb-50">
                    <h6 class="mb-15">Follow Us</h6>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-facebook-white.svg" alt="" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-twitter-white.svg" alt="" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-instagram-white.svg" alt="" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest-white.svg" alt="" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-youtube-white.svg" alt="" /></a>
                </div>
                <div class="site-copyright">Copyright 2022 © Nest. All rights reserved. Powered by AliThemes.</div>
            </div>
        </div>
    </div>
    <!--End header-->
    @yield('content')


    <footer class="main">
        <div class="container pb-30">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <p class="font-sm mb-0">&copy; 2024, <strong class="text-brand">BuyNet</strong> <br />All rights reserved</p>
                </div>
                <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                    <div class="hotline d-lg-inline-flex">
                        <img src="{{ asset('web/assets/imgs/theme/icons/phone-call.svg') }}" alt="hotline" />
                        <p>0713439884<span>24/7 Support Center</span></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                    <div class="mobile-social-icon">
                        <h6>Follow Us</h6>
                        <a href="#"><img src="{{ asset('web/assets/imgs/theme/icons/icon-facebook-white.svg') }}" alt="" /></a>
                        <a href="#"><img src="{{ asset('web/assets/imgs/theme/icons/icon-twitter-white.svg') }}" alt="" /></a>
                        <a href="#"><img src="{{ asset('web/assets/imgs/theme/icons/icon-instagram-white.svg') }}" alt="" /></a>
                        <a href="#"><img src="{{ asset('web/assets/imgs/theme/icons/icon-pinterest-white.svg') }}" alt="" /></a>
                        <a href="#"><img src="{{ asset('web/assets/imgs/theme/icons/icon-youtube-white.svg') }}" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <script>
        //script for voice search start
        var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        var SpeechGrammarList = window.SpeechGrammarList || window.webkitSpeechGrammarList;
    
        var grammar = '#JSGF V1.0';
        var recognition = new SpeechRecognition();
        var speechRecognitionList = new SpeechGrammarList();
        speechRecognitionList.addFromString(grammar, 1);
        recognition.grammar = speechRecognitionList;
        recognition.interimResults = false;
    
        recognition.onresult = function(event){
            var lastResult = event.results.length - 1;
            var content = event.results[lastResult][0].transcript;
            
            var inputField_keyword = document.querySelector('input[name="keyword"]');
            inputField_keyword.value = content;
            
            // Submit the form
            var voiceSearch_form = document.getElementById('voiceSearch_form');
            voiceSearch_form.submit();
        }
    
        recognition.onspeechend = function(){
            recognition.stop();
        }
    
        recognition.onerror = function(event) {
            console.log(event.error);
            const microphone = document.querySelector('.microphone')
            microphone.classList.remove('recording')
        }
    
        document.querySelector('.microphone').addEventListener('click', function(){
            recognition.start();
            const microphone = document.querySelector('.microphone')
            microphone.classList.add('recording')
        })
        //script for voice search ends
    </script>  

    <script>
        //script for voice search start
        var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        var SpeechGrammarList = window.SpeechGrammarList || window.webkitSpeechGrammarList;

        var grammar = '#JSGF V1.0';
        var recognition_for_command = new SpeechRecognition();
        var speechRecognitionList_command = new SpeechGrammarList();

        speechRecognitionList_command.addFromString(grammar, 1);
        recognition_for_command.grammar = speechRecognitionList_command;
        recognition_for_command.interimResults = false;

        recognition_for_command.onresult = function(event){
            var lastResult = event.results.length - 1;
            var content = event.results[lastResult][0].transcript;
            
            var inputField_voice = document.querySelector('input[name="voice"]');
            inputField_voice.value = content;
            
            // Submit the form
            var voiceCommandForm = document.getElementById('voice_command_form');
            voiceCommandForm.submit();
        }

        recognition_for_command.onspeechend = function(){
            recognition_for_command.stop();
        }

        recognition_for_command.onerror = function(event) {
            console.log(event.error);
            const microphone2 = document.querySelector('.voiceCommand')
            microphone2.classList.remove('recording')
        }

        document.querySelector('.voiceCommand').addEventListener('click', function(){
            recognition_for_command.start();
            const microphone2 = document.querySelector('.voiceCommand')
            microphone2.classList.add('recording')
        })
        //script for voice search ends
    </script>  

    <script src="{{ asset('web/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('web/assets/js/shop.js?v=5.3') }}"></script>
</body>

</html>