@extends('layouts.app')

@section('content')
    <div class="container col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">{{__('Creating new product')}}</div>

            <div class="card-body">
                <form action="{{route('products.store')}}" method="post" id="products-form">
                    @csrf
                    @include('product.partials.__form')
                </form>

                <div class="container d-flex col-lg-6 col-sm justify-content-around">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success" form="products-form">
                        <i class="fas 	fa fa-upload"></i> {{ __('Create') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection