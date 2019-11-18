@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Product</div>

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
                        <form action="/products" method="post" class="form-group">
                            @csrf
                            <label for="name">Product name:</label>
                            <input type="text" class="form-control mb-3" id="name" name="name"
                                   placeholder="Type company or person full name" value="{{ old("name") }}">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control mb-3" name="description"
                                   id="description" value="{{ old("description") }}"
                                   placeholder="Describe your product">
                            <label for="unit_price">Unit price:</label>
                            <input type="number" class="form-control mb-3" id="unit_price" name="unit_price"
                                   value="{{ old("unit_price") }}" step="0.01"
                                   placeholder="$ 00.00">
                            <label for="stock">Units in stock:</label>
                            <input type="number" class="form-control mb-3" id="stock" name="stock" step="0.01"
                                   value="{{old("stock")}}" placeholder="000">
                            <label for="category_id">Category id:</label>
                            <input type="number" class="form-control mb-3" id="category_id" name="category_id" step="0.01"
                                   value="{{old("category_id")}}" placeholder="000">
                            <button class="btn btn-primary form-control mt-2" type="submit">Submit</button>
                        </form>
                    </div>
                    <div class="row pt-2 justify-content-center" >
                        <a class="btn btn-secondary" href="/products">Back</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
