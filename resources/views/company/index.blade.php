@extends('layouts.app')

@section('content')
    <div class="container col-lg-9 col-md-12">
        <div class="d-flex justify-content-center">
            <h2 class="align-self-end text-center">{{__('Companies')}}</h2>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-around align-items-end">
                <div class="col-lg-4 col-sm-auto justify-content-center">
                    <a class="btn btn-primary" href="{{route('companies.create')}}">{{__('Add a new company')}}</a>
                </div>
                <div class="col-lg-5 col-sm-auto align-self-auto justify-content-center">
                    <form action="{{route('companies.search')}}" method="post" role="search">
                        @csrf
                        <div class="input-group md-form form-sm form-1 pl-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-search text-gray" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input aria-label="Search" class="form-control my-0 py-1" id="companySearch"
                                   name="companySearch" placeholder="Search" type="text">
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body container">
                <table class="table">
                    <tr class="row">
                        <th class="col-4 pl-5">Full Name or Company Name</th>
                        <th class="col-2">NIT</th>
                        <th class="col">Address</th>
                        <th class="col-2"></th>
                    </tr>
                    @foreach($companies as $company)
                        @include('company.partials.__row')
                    @endforeach
                </table>
                {!! $companies->links() !!}
            </div>
        </div>
    </div>

@endsection
