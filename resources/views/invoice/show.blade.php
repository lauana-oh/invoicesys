@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header alert-dark">Showing details of <strong>Invoice #{{$invoice->id}}</strong></div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <table>
                            <tr>
                                <td class="p-3"><strong>Due Date:</strong> {{$invoice->due_date}}</td>
                                <td class="p-3"><strong>Delivery Date:</strong> {{$invoice->delivery_date}}</td>
                                <td class="p-3"><strong>Invoice Date:</strong> {{$invoice->invoice_date}}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col justify-content-center">
                            <ul>
                                <li><strong>Client:</strong> {{$invoice->client->name}}</li>
                                <li><strong>NIT:</strong> {{$invoice->client->nit}}</li>
                                <li><strong>Email:</strong> {{$invoice->client->email}}</li>
                                <li><strong>Phone:</strong> {{$invoice->client->phone}}</li>
                                <li><strong>Address:</strong> {{$invoice->client->address}}</li>
                            </ul>
                        </div>
                        <div class="col justify-content-center">
                            <ul>
                                <li><strong>Vendor:</strong> {{$invoice->vendor->name}}</li>
                                <li><strong>NIT:</strong> {{$invoice->vendor->nit}}</li>
                                <li><strong>Email:</strong> {{$invoice->vendor->email}}</li>
                                <li><strong>Phone:</strong> {{$invoice->vendor->phone}}</li>
                                <li><strong>Address:</strong> {{$invoice->vendor->address}}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row ">
                        <a class="btn btn-primary m-2" href="/invoices/{{$invoice->id}}/edit">Edit</a>
                        <a class="btn btn-primary m-2" href="/invoices/{{$invoice->id}}/confirmDelete">Delete</a>
                        <a class="btn btn-secondary m-2" href="/invoices/">Back</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header navbar-nav">
                    <table>
                        <tr>
                            <th class="col w-75">Order details of invoice #{{$invoice->id}}</th>
                            <th class="col"><a class="btn btn-link" href="/invoices/{{$invoice->id}}/orders/create">+ Add product</a></th>
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
                                    <td class="text-center"><a href="/invoices/{{$invoice->id}}/orders/{{$order->id}}">{{$order->id}}</a></td>
                                    <td>{{$order->product->name}}</td>
                                    <td class="text-center">$ {{$order->unit_price}}</td>
                                    <td class="text-center">$ {{$order->unit_price}} </td>
                                    <td class="text-center">{{$order->productIva}}%</td>
                                    <td class="text-center"><a href="/invoices/{{$invoice->id}}/orders/{{$order->id}}/edit">Edit</a></td>
                                    <td class="text-center"><a href="/invoices/{{$invoice->id}}/orders/{{$order->id}}/confirmDelete">Delete</a> </td>
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
