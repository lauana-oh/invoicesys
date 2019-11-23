@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header alert-dark">Showing order #{{$order->id}} details</div>

                <div class="card-body">

                    <div class="row">
                        <ul>
                            <li><strong>ID:</strong> #{{$order->id}}</li>
                            <li><strong>Invoice:</strong> #{{$order->invoice->id}}</li>
                            <li><strong>Product:</strong> {{$order->product->name}}</li>
                            <li><strong>Category:</strong> {{$order->product->category->name}}</li>
                            <li><strong>Unit price:</strong> ${{$order->unit_price}}</li>
                            <li><strong>Quantity:</strong> {{$order->quantity}}</li>
                            <li><strong>Total price:</strong> ${{$order->unit_price}}</li>
                            <li><strong>Iva:</strong> {{$order->productIva}}%</li>
                            <li><strong>Iva paid:</strong> ${{$order->productIva}}</li>
                        </ul>
                    </div>
                    <div class="row ">
                        <a class="btn btn-primary m-2" href="/invoices/{{$invoice->id}}/orders/{{$order->id}}/edit">Edit</a>
                        <a class="btn btn-primary m-2" href="/invoices/{{$invoice->id}}/orders/{{$order->id}}/confirmDelete">Delete</a>
                        <a class="btn btn-secondary m-2" href="/invoices/{{$invoice->id}}">Back</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
