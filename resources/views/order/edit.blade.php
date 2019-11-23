@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editing order #{{$order->id}} of Invoice #{{$invoice->id}}</div>

                <div class="card-body">
                    <div class="row">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="row justify-content-center">
                        <form action="/invoices/{{$invoice->id}}/orders/{{$order->id}}" method="post" class="form-group">
                            @csrf
                            @method('put')
                            <div class="form-row form-group">
                                <div class="col col-3">
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" step="0.01"
                                           value="{{old("quantity", $order->quantity)}}" placeholder="000">
                                </div>

                                <div class="col col-9">
                                    <label for="product">Product:</label>
                                    <input list="products" name="product" id="product" class="form-control"
                                           placeholder="Select product" value="{{old("product",$order->product->name)}}">
                                    <datalist id="products">
                                        @foreach($products as $product)
                                            <option value="{{$product->name}}">
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button class="btn btn-primary m-2" type="submit">Submit</button>
                                <a class="btn btn-secondary m-2" href="/invoices/{{$invoice->id}}">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
