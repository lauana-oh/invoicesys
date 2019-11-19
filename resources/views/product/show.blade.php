@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Showing {{$product->name}} details</div>

                <div class="card-body">
                    <div class="row">
                        <ul>
                            <li><strong>ID:</strong>{{$product->id}}</li>
                            <li><strong>Name:</strong> {{$product->name}}</li>
                            <li><strong>Description:</strong> {{$product->description}}</li>
                            <li><strong>Unit price:</strong>$ {{$product->unit_price}}</li>
                            <li><strong>Stock:</strong> {{$product->stock}}</li>
                            <li><strong>Category:</strong> {{$product->category->name}}</li>
                            <li><strong>Iva:</strong> {{$product->category->iva}}%</li>
                        </ul>
                    </div>
                    <div class="row ">
                        <a class="btn btn-primary m-2" href="/products/{{$product->id}}/edit">Edit</a>
                        <a class="btn btn-primary m-2" href="/products/{{$product->id}}/confirmDelete">Delete</a>
                        <a class="btn btn-secondary m-2" href="/products/">Back</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
