@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header alert-dark">Delete {{$company->name}}?</div>

                <div class="card-body">
                    <div class="row">
                        @if($errors->any())
                            <div class="alert alert-dark">
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
                            <li><strong>NIT:</strong>{{$company->nit}}</li>
                            <li><strong>Name:</strong> {{$company->name}}</li>
                            <li><strong>E-mail:</strong> {{$company->email}}</li>
                            <li><strong>Phone number:</strong>{{$company->phone}}</li>
                            <li><strong>Address:</strong>{{$company->address}}</li>
                        </ul>
                    </div>
                    <div class="row ">
                        <form action="/companies/{{$company->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-primary m-2 alert-danger" type="submit">Delete</button>
                        </form>

                        <a class="btn btn-secondary m-2" href="/companies/">Back</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
