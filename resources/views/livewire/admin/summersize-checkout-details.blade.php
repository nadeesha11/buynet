<div class="col-lg-5">
    <div class="border p-40 cart-totals ml-30 mb-50">
        <div class="d-flex align-items-end justify-content-between mb-30">
            <h4>Your Order</h4>
            <h6 class="text-muted">$ {{ $final_price }}</h6>
        </div>
        <div class="divider-2 mb-30"></div>
        <div class="table-responsive order_table checkout">
            <table class="table no-border">
                <tbody>
                  
                   @forelse ($cartItems as $item)
                   <tr>
                    <td class="image product-thumbnail"><img src="{{ 'product_images/'.$item->image_name }}" alt="#"></td>
                    <td>
                        <h6 class="w-160 mb-5"><a  class="text-heading">{{ $item->product_title }} </a></h6></span>
                    </td>
                    <td>
                        <h6 class="text-muted pl-20 pr-20">x {{ $item->qty }}</h6>
                    </td>
                    <td>
                        <h6 class="text-brand">$ {{ $item->total }}</h6>
                    </td>
                </tr>
                   @empty
                      <p>there is no cart products</p> 
                   @endforelse
                   
                </tbody>
            </table>
        </div>
    </div>
   
</div>
