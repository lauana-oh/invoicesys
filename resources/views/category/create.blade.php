@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">Create new category</div>
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
                        <form action="/categories" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Category name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Type a new category" value="{{old("name")}}">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description" value="{{old("description")}}"
                                       id="description" placeholder="Describe this new category...">
                                <label for="iva">I.v.a. (%)</label>
                                <input type="number" class="form-control" id="iva" name="iva" step="0.1"
                                       placeholder="Type the corresponded iva of this category" value="{{old("iva")}}">
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
