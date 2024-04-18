@extends('layout.webLayout')
@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                 <span></span> Detailed wishlist
            </div>
        </div>
    </div>
    <div class="container mb-30 mt-50">
       @livewire('Admin.ViewWishListComponent')
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('trash_wishlist_success', () => {
            Swal.fire({
                title: 'Success!',
                text: 'product removed wishlist.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });

        Livewire.on('trash_wishlist_failed', () => {
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });
</script>
@endsection