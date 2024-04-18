<div class="product-action-1">
    <a aria-label="Add To Wishlist" wire:click.prevent="addToWishlist" class="action-btn" ><i class="fi-rs-heart"></i></a>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('product_already_in_wishlist', () => {
            Swal.fire({
                title: 'Error!',
                text: 'Product already in wishlist.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });

    });
</script>
