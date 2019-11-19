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
                            <div class="form-group row">
                                <label for="name">Product name:</label>
                                <input type="text" class="form-control " id="name" name="name"
                                       placeholder="Type your product name" value="{{ old("name") }}">
                            </div>
                            <div class="form-group row">
                                <label for="description">Description:</label>
                                <textarea class="form-control" name="description"
                                          id="description" value="{{ old("description") }}"
                                          placeholder="Describe your product"></textarea>
                            </div>
                            <div class="form-group row">
                                <label for="unit_price">Unit price:</label>
                                <input type="number" class="form-control" id="unit_price" name="unit_price"
                                       value="{{ old("unit_price") }}" step="0.01"
                                       placeholder="$ 00.00">
                            </div>
                            <div class="form-group row">
                                <label for="stock">Units in stock:</label>
                                <input type="number" class="form-control" id="stock" name="stock" step="0.01"
                                       value="{{old("stock")}}" placeholder="000">
                            </div>
                            <div class="form-group row">
                                <label for="category">Category:</label>
                                <input list="categories" name="category" id="category" class="form-control"
                                       placeholder="Select category">
                                <datalist id="categories">
                                    @foreach($categories as $category)
                                        <option value="{{$category->name}}">
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="row">
                                <button class="btn btn-primary form-control mt-2" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="row pt-2 justify-content-center" >
                        <a class="btn btn-secondary" href="/products">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
