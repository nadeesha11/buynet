@extends('layout.layout')
@section('section')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Order detail</h2>
            <p>Details for Order ID: {{ $order->id }}</p>
        </div>
    </div>
    <div class="card">
        <header class="card-header">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
                    <span> <i class="material-icons md-calendar_today"></i> <b> {{ $order->created_at }}</b> </span> <br />
                    <small class="text-muted">Order ID: {{ $order->id }}</small>
                </div>
                <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                 
                    <a class="btn btn-secondary print ms-2" href="#"><i class="icon material-icons md-print"></i></a>
                </div>
            </div>
        </header>
        <!-- card-header end// -->
        <div class="card-body">
            <div class="row mb-50 mt-20 order-info-wrap">
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-person"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Customer</h6>
                            <p class="mb-1">
                                {{ $order->fname }} {{ $order->lname }} <br />
                                {{ $order->phone }} <br />
                                {{ $order->email }}
                            </p>
                            
                        </div>
                    </article>
                </div>
              
                <!-- col// -->
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-place"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Deliver to</h6>
                            <p class="mb-1">
                                {{ $order->adress_1 }} <br /> {{ $order->adress_2 }}  <br />
                                {{ $order->district }} <br />

                                {{ $order->postal }} <br />
                               
                            </p>
                          
                        </div>
                    </article>
                </div>
                <!-- col// -->
            </div>
            <!-- row // -->
            <div class="row">
                <div class="col-lg-7">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="40%">Product</th>
                                    <th width="20%">Unit Price</th>
                                    <th width="20%">Quantity</th>
                                    <th width="20%" class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse ($order_list as $item)
                              <tr>
                                <td>
                                    <a class="itemside" href="#">
                                        <div class="info">{{ $item->product_title }}</div>
                                    </a>
                                </td>
                                <td>${{ $item->product_price }}</td>
                                <td>{{ $item->qty }}</td>
                                <td class="text-end">$ {{ $item->sub_total }}</td>
                            </tr>  
                              @empty
                                  
                              @endforelse
                               
                               
                            
                                <tr>
                                    <td colspan="4">
                                        <article class="float-end">
                                            
                                            <dl class="dlist">
                                                <dt>Grand total:</dt>
                                                <dd><b class="h5">$ {{ $order->total }}</b></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dd>
                                                    <span class="badge rounded-pill alert-success text-success">Payment done</span>
                                                </dd>
                                            </dl>
                                        </article>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- table-responsive// -->
                </div>
                <!-- col// -->
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <div class="box shadow-sm bg-light">
                        <h6 class="mb-15">Additional info</h6>
                        <p>
                            {{ $order->additional_info }}
                        </p>
                    </div>
                   
                </div>
                <!-- col// -->
            </div>
        </div>
        <!-- card-body end// -->
    </div>
    <!-- card end// -->
</section>
@endsection




























































