@extends('layouts.app')

@section('content')
    <div class="container col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">{{__('Showing company')}} <strong>{{$company->name}}</strong></div>

            <div class="card-body">

                @include('company.partials.__details')

                <div class="container d-flex col-lg-6 col-sm justify-content-around">
                    <a href="{{ route('companies.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                    <a href="{{ route('companies.edit', $company) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> {{ __('Edit') }}
                    </a>
                    <a href="{{ route('companies.confirmDelete', $company) }}" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection