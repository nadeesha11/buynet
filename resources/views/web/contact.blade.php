@extends('layout.webLayout')
@section('content')
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span>  Contact
            </div>
        </div>
    </div>
    <div class="page-content ">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto mt-50">
                    <section class="mb-50">
                       
                        <div class="row">
                            <div class="col-xl-8">
                                @livewire('Admin.Contact')
                               
                            </div>
                            <div class="col-lg-4 pl-50">
                                <div class="mb-4 mb-md-0">
                                    <h4 class="mb-15 text-brand">Office</h4>
                                    671/B A12, Dambulla 21100<br />
                                    ,Sri Lanka<br />
                                    <abbr title="Phone">Phone:</abbr> 0713439884<br />
                                    <abbr title="Email">Email: </abbr>contact@buynet.com<br />
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection