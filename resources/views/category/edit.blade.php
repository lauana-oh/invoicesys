@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">Editing {{$category->name}}</div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
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
                        <form action="/categories/{{$category->id}}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Category name</label>
                                <input type="text" class="form-control mb-3" id="name" name="name"
                                       placeholder="Type a new category" value="{{old("name",$category->name)}}">
                                <label for="description">Description</label>
                                <input type="text" class="form-control mb-3" name="description"
                                       value="{{old("description",$category->description)}}"
                                       id="description" placeholder="Describe this new category...">
                                <label for="iva">I.v.a. (%)</label>
                                <input type="number" class="form-control mb-3" id="iva" value="{{old("iva",$category->iva)}}"
                                       placeholder="Type the corresponded iva of this category" name="iva" step="0.1">
                            </div>
                            <div class="row align-items-center">
                                <div class="col">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                                <div class="col">
                                    <a class="btn btn-secondary" href="/categories/">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
