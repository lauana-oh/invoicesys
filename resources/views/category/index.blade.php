@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">Categories</div>

                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <a class="btn btn-primary mb-3 ml-2" href="/categories/create">Create a new category</a>
                    </div>
                    <div class="row">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>IVA</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->description}}</td>
                                    <td>{{$category->iva}} %</td>
                                    <td><a href="/categories/{{$category->id}}/edit">Edit</a></td>
                                    <td><a href="/categories/{{$category->id}}/confirmDelete">Delete</a> </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
