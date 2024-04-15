@extends('layout.webLayout')
@section('content')
<style>
       .jumbotron {
            background-color: #cfe2cf;
            color: #000000;
            padding: 2rem 1rem;
            margin-top: 3rem;
        }
        .jumbotron h1 {
            font-size: 2.5rem;
        }
        .jumbotron p {
            font-size: 1.2rem;
        }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-4 mb-4">
            <div class="jumbotron text-center">
                <h1 class="display-4">Payment Successful</h1>
                <p class="lead">Thank you for your payment!</p>
                <hr class="my-4">
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="{{ route('web.home') }}" role="button">Go to Home</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection























