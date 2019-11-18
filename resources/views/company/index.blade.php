@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies</div>

                <div class="card-body">
                    <div class="row">
                        <a class="btn btn-primary m-2 mb-4" href="/companies/create">Create a new company</a>
                    </div>
                    <div class="row">
                        <table class="table">
                            <tr>
                                <th>Full Name or Company Name</th>
                                <th>NIT</th>
                                <th>E-mail</th>
                                <th>Phone number</th>
                                <th>Address</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($companies as $company)
                                <tr>
                                    <td><a href="/companies/{{$company->id}}">{{$company->name}}</a></td>
                                    <td>{{$company->nit}}</td>
                                    <td>{{$company->email}}</td>
                                    <td>{{$company->phone}}</td>
                                    <td>{{$company->address}}</td>
                                    <td><a href="/companies/{{$company->id}}/edit">Edit</a></td>

                                    <td><a href="/companies/{{$company->id}}/confirmDelete">Delete</a> </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
