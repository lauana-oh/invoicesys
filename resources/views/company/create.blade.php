@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Company</div>

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
                        <form action="/companies" method="post" class="form-group">
                            @csrf
                            <label for="name">Full name OR Company Name:</label>
                            <input type="text" class="form-control mb-3" id="name" name="name"
                                   placeholder="Type company or person full name" value="{{ old("name")}}">
                            <label for="nit">NIT:</label>
                            <input type="number" class="form-control mb-3" name="nit"
                                   id="nit" value="{{ old("nit")}}"
                                   placeholder="Write NIT for this name">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control mb-3" id="email" name="email"
                                   value="{{ old("email")}}"
                                   placeholder="company@email.com">
                            <label for="phone">Phone number:</label>
                            <input type="number" class="form-control mb-3" id="phone" name="phone"
                                   value="{{old("phone")}}" placeholder="000 000 0000">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control mb-3" name="address" id="address" placeholder="Type address"
                                   value="{{old("address")}}">
                            <button class="btn btn-primary form-control mt-2" type="submit">Submit</button>
                        </form>
                    </div>
                    <div class="row pt-2 justify-content-center" >
                        <a class="btn btn-secondary" href="/companies">Back</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
