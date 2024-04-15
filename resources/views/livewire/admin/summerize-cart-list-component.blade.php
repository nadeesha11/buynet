<div class="header-action-icon-2">
    <a class="mini-cart-icon" href="#">
        <img alt="Nest" src="{{ asset('web/assets/imgs/theme/icons/icon-cart.svg') }}" />
        <span class="pro-count blue">{{ $cartItems->count() }}</span>
    </a>
    <a href="#"><span class="lable">Cart</span></a>
    @if(session('customer_data'))
    @if (count($cartItems) > 0)
    <div class="cart-dropdown-wrap cart-dropdown-hm2">
        <ul>
            @forelse ($cartItems as $item)
            <li>
                <div class="shopping-cart-img">
                    <a href="#"><img alt="Nest" src="{{ 'product_images/'.$item->image_name }}" /></a>
                </div>
                <div class="shopping-cart-title">
                    <h4><a href="#">{{ \Illuminate\Support\Str::limit($item->product_title, 15, $end='...') }}</a></h4>
                    <h4><span>{{ $item->qty }} × </span>${{ $item->total }}</h4>
                </div>                
                <div class="shopping-cart-delete">
                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                </div>
            </li>
            @empty
                <p>There are no items</p>
            @endforelse
          
        </ul>
        <div class="shopping-cart-footer">
            <div class="shopping-cart-button">
                <a href="{{ route('web.detailedCart') }}" class="outline">View cart</a>
                <a href="shop-checkout.html">Checkout</a>
            </div>
        </div>
    </div> 
    @else
        
    @endif
    
    @else
       
    @endif
    
</div>
