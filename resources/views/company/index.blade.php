@extends('layouts.app')

@section('content')
    <div class="container col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-end">
                <div class="col-lg-3 col-sm-auto">
                    <h4>{{__('Companies')}}</h4>
                </div>
                <div class="col-lg-3 col-sm-auto align-self-auto">
                    <a class="btn btn-primary" href="{{route('companies.create')}}">{{__('Add a new company')}}</a>
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
            </div>
        </div>
    </div>

@endsection
