@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit {{$product->name}} Product</div>

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
                        <form action="/products/{{$product->id}}" method="post">
                            @csrf
                            @method('put')
                            <label for="name">Product name:</label>
                            <input type="text" class="form-control mb-3" id="name" name="name"
                                   placeholder="Type company or person full name" value="{{ old("name",$product->name) }}">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control mb-3" name="description"
                                   id="description" value="{{ old("description", $product->description) }}"
                                   placeholder="Describe your product">
                            <label for="unit_price">Unit price:</label>
                            <input type="number" class="form-control mb-3" id="unit_price" name="unit_price"
                                   value="{{ old("unit_price",$product->unit_price) }}" step="0.01"
                                   placeholder="$ 00.00">
                            <label for="stock">Units in stock:</label>
                            <input type="number" class="form-control mb-3" id="stock" name="stock" step="0.01"
                                   value="{{old("stock",$product->stock)}}" placeholder="000">
                            <label for="category_id">Units in stock:</label>
                            <input type="number" class="form-control mb-3" id="category_id" name="category_id" step="1"
                                   value="{{old("category_id",$product->category_id)}}" placeholder="0">
                            <button class="btn btn-primary form-control mt-2" type="submit">Submit</button>
                        </form>
                    </div>
                    <div class="row pt-2 justify-content-center">
                        <a class="btn btn-secondary" href="/products/">Back</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
