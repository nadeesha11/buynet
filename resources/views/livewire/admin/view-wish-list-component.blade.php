<div class="row">
    <div class="col-xl-10 col-lg-12 m-auto">
        <div class="mb-50">
            <h1 class="heading-2 mb-10">Your Wishlist</h1>
            <h6 class="text-body">There are <span class="text-brand">{{ $wishlist->count() }}</span> products in this list</h6>
        </div>
        <div class="table-responsive shopping-summery">
            <table class="table table-wishlist">
                <thead>
                    <tr class="main-heading">
                       
                        <th scope="col" colspan="2">Product</th>
                        <th scope="col">Action</th>
                        <th scope="col" class="end">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($wishlist as $item)
                    <tr class="pt-30">
                      
                        <td class="image product-thumbnail pt-40"><img src="{{ 'product_images/'.$item->image_name }}" alt="#" /></td>
                        <td class="product-des product-name">
                            <h6><a class="product-name mb-10" href="#">{{ $item->product_title }}</a></h6>
                        </td>
                       
                        <td class="text-right" data-title="Cart">
                            <button wire:click.prevent="add_to_cart('{{ $item->pro_id }}','{{ $item->id }}')" class="btn btn-sm">Add to cart</button>
                        </td>
                        <td class="action text-center" data-title="Remove">
                            <a wire:click.prevent="deleteWishlist('{{ $item->id }}')" class="text-body"><i class="fi-rs-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">  <p>Wishlist empty</p></td>
                    </tr>
                      
                    @endforelse
                 
                
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('product_already_exits_in_cart', () => {
            Swal.fire({
                title: 'Error!',
                text: 'Product Already Exits In Cart.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });
</script>
