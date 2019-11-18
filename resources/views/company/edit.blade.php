@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit {{$company->name}}</div>

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
                        <form action="/companies/{{$company->id}}" method="post">
                            @csrf
                            @method('put')
                            <label for="name">Full name OR Company Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Type company or person full name" value="{{ old("name", $company->name) }}">
                            <label for="nit">NIT:</label>
                            <input type="number" class="form-control" name="nit"
                                   id="nit" value="{{ old("nit", $company->nit) }}"
                                   placeholder="Write NIT for this name">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ old("iva", $company->email) }}"
                                   placeholder="company@email.com">
                            <label for="phone">Phone number:</label>
                            <input type="number" class="form-control" id="phone" name="phone"
                                   value="{{old("phone",$company->phone)}}" placeholder="000 000 0000">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Type address"
                                   value="{{old("address",$company->address)}}">
                            <button class="btn btn-primary form-control mt-2" type="submit">Submit</button>
                        </form>
                    </div>
                    <div class="row pt-2 justify-content-center">
                        <a class="btn btn-secondary" href="/companies/">Back</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
