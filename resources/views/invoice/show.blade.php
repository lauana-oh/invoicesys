@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header alert-dark">Showing details of <strong>Invoice{{$invoice->idFormatted}}</strong></div>

                <div class="card-body">
                    <div class="row justify-content-xl-center mb-3">
                        <table>
                            <tr>
                                <td class="col-auto"><strong>Due Date:</strong> {{$invoice->due_date}}</td>
                                <td class="col-auto"><strong>Delivery Date:</strong> {{$invoice->delivery_date}}</td>
                                <td class="col-auto"><strong>Invoice Date:</strong> {{$invoice->invoice_date}}</td>
                            </tr>
                            <tr>
                                <td class="col-auto"><strong>Total:</strong>{{$invoice->totalPaidFormatted}}</td>
                                <td class="col-auto"><strong>Total IVA:</strong>{{$invoice->totalIvaPaidFormatted}}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="row justify-content-center mb-3">
                        <div class="col justify-content-center col-5 border">
                            <ul class="list-unstyled">
                                <li><strong>Client:</strong> {{$invoice->client->name}}</li>
                                <li><strong>NIT:</strong> {{$invoice->client->nit}}</li>
                                <li><strong>Email:</strong> {{$invoice->client->email}}</li>
                                <li><strong>Phone:</strong> {{$invoice->client->phone}}</li>
                                <li><strong>Address:</strong> {{$invoice->client->address}}</li>
                            </ul>
                        </div>
                        <div class="col col-auto"></div>
                        <div class="col justify-content-center col-5 border">
                            <ul class="list-unstyled ">
                                <li><strong>Vendor:</strong> {{$invoice->vendor->name}}</li>
                                <li><strong>NIT:</strong> {{$invoice->vendor->nit}}</li>
                                <li><strong>Email:</strong> {{$invoice->vendor->email}}</li>
                                <li><strong>Phone:</strong> {{$invoice->vendor->phone}}</li>
                                <li><strong>Address:</strong> {{$invoice->vendor->address}}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <a class="btn btn-primary m-2" href="{{route("invoices.edit", $invoice->id)}}">Edit</a>
                        <a class="btn btn-primary m-2" href="{{route("invoices.confirmDelete", $invoice->id)}}">Delete</a>
                        <a class="btn btn-secondary m-2" href="/invoices/">Back</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header navbar-nav">
                    <table>
                        <tr>
                            <th class="col w-75">Order details of invoice</th>
                            <th class="col"><a class="btn btn-link" href="{{route("orders.create", $invoice->id)}}">+ Add product</a></th>
                        </tr>
                    </table>
                </div>

                <div class="card-body">
                    <div class="row">
                        <table class="table">
                            <tr>
                                <th class="text-center">Quantity</th>
                                <th class="w-25">Product</th>
                                <th class="text-center">Unit Price</th>
                                <th class="text-center">Total Price</th>
                                <th class="text-center">IVA</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="text-center">{{$order->quantityFormatted}}</td>
                                    <td><a href="{{route("orders.show", [$invoice->id, $order->id])}}">{{$order->product->name}}</a></td>
                                    <td class="text-center">{{$order->unitPriceFormatted}}</td>
                                    <td class="text-center">{{$order->totalPriceFormatted}} </td>
                                    <td class="text-center">{{$order->productIvaFormatted}}</td>
                                    <td class="text-center"><a href="{{route("orders.edit", [$invoice->id, $order->id])}}">Edit</a></td>
                                    <td class="text-center"><a href="{{route("orders.confirmDelete", [$invoice->id, $order->id])}}">Delete</a> </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
