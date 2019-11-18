@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Showing {{$company->name}} details</div>

                <div class="card-body">
                    <div class="row">
                        <ul>
                            <li><strong>ID:</strong>{{$company->id}}</li>
                            <li><strong>NIT:</strong>{{$company->nit}}</li>
                            <li><strong>Name:</strong> {{$company->name}}</li>
                            <li><strong>E-mail:</strong> {{$company->email}}</li>
                            <li><strong>Phone number:</strong>{{$company->phone}}</li>
                            <li><strong>Address:</strong>{{$company->address}}</li>
                        </ul>
                    </div>
                    <div class="row ">
                        <a class="btn btn-primary m-2" href="/companies/{{$company->id}}/edit">Edit</a>
                        <a class="btn btn-primary m-2" href="/companies/{{$company->id}}/confirmDelete">Delete</a>
                        <a class="btn btn-secondary m-2" href="/companies/">Back</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
