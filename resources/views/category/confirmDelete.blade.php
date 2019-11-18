@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header alert-dark">
                    <div class="row">
                        <div class="col">Delete {{$category->name}}?</div>
                    </div>
                </div>

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
                    <div class="row">
                        <ul>
                            <li><strong>ID:</strong> {{$category->id}}</li>
                            <li><strong>Category:</strong> {{$category->name}}</li>
                            <li><strong>Description:</strong> {{$category->description}}</li>
                            <li><strong>Iva:</strong> {{$category->iva}}%</li>
                        </ul>
                    </div>
                    <div class="row ">
                        <form action="/categories/{{$category->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-primary m-2 alert-danger" type="submit">Delete</button>
                        </form>
                        <a class="btn btn-secondary m-2" href="/categories/">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
