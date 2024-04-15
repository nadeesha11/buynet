<tbody>  
@forelse ($cartItems as $item)
<tr>
    <td class="image product-thumbnail"><img src="{{ 'product_images/'.$item->image_name }}" alt="#"></td>
    <td class="product-des product-name">
        <h6 style="font-size: 12px !important;" class="mb-5"><a class="product-name mb-10 text-heading" href="#">{{ $item->product_title }}</a></h6>
    </td>
    <td class="price" data-title="Price">
        <h4 style="font-size: 12px !important;" class="text-body">Rs. {{ $item->product_price }} </h4>
    </td>
    <td class="text-center detail-info" data-title="Stock">
        <div class="detail-extralink mr-15">
            <a wire:click.prevent="add_cart_qty_up('{{ $item->id }}')"><i class="fi-rs-add m-2"></i></a>
            <span>{{ $item->qty }}</span>
           <a wire:click.prevent="add_cart_qty_down('{{ $item->id }}')"><span class="fi-rs-minus-small m-2"></span></a> 
        </div>
    </td>
    <td class="price" data-title="Price">
        <h4 style="font-size: 12px !important;" class="text-brand">Rs. {{ $item->total }}</h4>
    </td>
    <td class="action text-center" data-title="Remove"><a wire:click.prevent="deleteCartItem('{{ $item->id }}')" class="text-body"><i class="fi-rs-trash"></i></a></td>
</tr>
@empty  
@endforelse
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('trash_cart_success', () => {
            Swal.fire({
                title: 'Success!',
                text: 'Item removed form cart.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });

        Livewire.on('trash_cart_failed', () => {
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });

        Livewire.on('update_cart_fail', () => {
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });
</script>
</tbody>