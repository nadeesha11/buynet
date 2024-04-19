@extends('layout.webLayout')
@section('content')

<div class="invoice invoice-content invoice-4">
    <div class="back-top-home hover-up mt-30 ml-30">
        <a class="hover-up" href="{{ route('web.home') }}"><i class="fi-rs-home mr-5"></i> Homepage</a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-inner">
                    <div class="invoice-info" id="invoice_wrapper">
                        <div class="invoice-header">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                   
                                    <p class="invoice-addr-1 mt-10">
                                        <strong>Invoice Number:</strong> <strong class="text-brand">{{ $order->id }}</strong> <br />
                                        <strong>Invoice Data:</strong> {{ $order->created_at }} <br />
                                      
                                    </p>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="invoice-number">
                                        <h4 class="invoice-title-1 mb-10">Delivery To</h4>
                                        <p class="invoice-addr-1">
                                            <strong class="text-brand">  {{ $order->fname }} {{ $order->lname }}</strong> <br />
                                            {{ $order->adress_1 }} {{ $order->adress_2 }}<br />
                                            {{ $order->district }} , {{ $order->postal }}<br />
                                            <abbr title="Phone">Phone:</abbr>  {{ $order->phone }}<br />
                                            <abbr title="Email">Email: </abbr>{{ $order->email }}<br />
                                        </p>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="invoice-center">
                            <div class="table-responsive">
                                <table class="table table-striped invoice-table">
                                    <thead class="bg-active">
                                        <tr>
                                            <th>Item Item</th>
                                            <th class="text-center">Unit Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($order_list as $item)
                                        <tr>
                                            <td>
                                                {{ $item->product_title }}
                                            </td>
                                            <td class="text-center">${{ $item->product_price }}</td>
                                            <td class="text-center">{{ $item->qty }}</td>
                                            <td class="text-right">$ {{ $item->sub_total }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                        
                                            <td colspan="4" class="text-right">There are no orders</td>
                                        </tr>
                                        @endforelse
                                       
                                        <tr>
                                            <td colspan="3" class="text-end f-w-600">Grand Total</td>
                                            <td class="text-right f-w-600">$ {{ $order->total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection