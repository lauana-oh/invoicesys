@extends('layouts.app')

@section('content')
    <div class="container col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">{{__('Editing company')}} {{$company->name}}</div>

            <div class="card-body">
                <form action="{{route('companies.update',$company)}}" method="post" id="companies-form">
                    @csrf
                    @method('put')
                    @include('company.partials.__form')
                </form>

                <div class="container d-flex col-lg-6 col-sm justify-content-around">
                    <a href="{{ route('companies.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success" form="companies-form">
                        <i class="fas fa-edit"></i> {{ __('Update') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
