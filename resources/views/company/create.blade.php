@extends('layouts.app')

@section('content')
    <div class="container col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">{{__('Creating new company')}}</div>

            <div class="card-body">
                <form action="{{route('companies.store', $company)}}" method="post" id="companies-form">
                    @csrf
                    @include('company.partials.__form')
                </form>

                <div class="container d-flex col-lg-6 col-sm justify-content-around">
                    <a href="{{ route('companies.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success" form="companies-form">
                        <i class="fas 	fa fa-upload"></i> {{ __('Create') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
