@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                    <div class="row">
                        <a class="btn btn-primary mb-4 ml-2" href="/products/create">Add a new product</a>
                    </div>
                    <div class="row">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Unit Price</th>
                                <th>Quantity in stock</th>
                                <th>Category</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->unit_price}}</td>
                                    <td>{{$product->stock}} </td>
                                    <td>{{$product->category_id}}</td>
                                    <td><a href="/products/{{$product->id}}/edit">Edit</a></td>
                                    <td><a href="/products/{{$product->id}}/confirmDelete">Delete</a> </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
