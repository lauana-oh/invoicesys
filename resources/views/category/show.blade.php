@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">Showing {{$category->name}} details</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <ul>
                            <li><strong>ID:</strong> {{$category->id}}</li>
                            <li><strong>Category:</strong> {{$category->name}}</li>
                            <li><strong>Description:</strong> {{$category->description}}</li>
                            <li><strong>Iva:</strong> {{$category->iva}}%</li>
                        </ul>
                    </div>
                    <div class="row m-1">
                        <a class="btn btn-primary m-2" href="/categories/{{$category->id}}/edit">Edit</a>
                        <a class="btn btn-primary m-2" href="/categories/{{$category->id}}/confirmDelete">Delete</a>
                        <a class="btn btn-secondary m-2" href="/categories/">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
