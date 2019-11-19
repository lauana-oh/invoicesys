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
                                <th class="text-center">ID</th>
                                <th class="w-25">Product</th>
                                <th class="text-center">Unit Price</th>
                                <th class="text-center">Quantity in stock</th>
                                <th class="text-center">Category</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($products as $product)
                                <tr>
                                    <td class="text-center">{{$product->id}}</td>
                                    <td><a href="/products/{{$product->id}}">{{$product->name}}</a></td>
                                    <td class="text-center">$ {{$product->unit_price}}</td>
                                    <td class="text-center">{{$product->stock}} </td>
                                    <td class="text-center">{{$product->category->name}}</td>
                                    <td class="text-center"><a href="/products/{{$product->id}}/edit">Edit</a></td>
                                    <td class="text-center"><a href="/products/{{$product->id}}/confirmDelete">Delete</a> </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
