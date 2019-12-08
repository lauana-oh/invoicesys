@extends('layouts.app')

@section('content')
    <div class="container col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">{{__('Showing product')}} {{$product->name}}</div>

            <div class="card-body">

                @include('product.partials.__details')

                <div class="container d-flex col-lg-6 col-sm justify-content-around">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> {{ __('Edit') }}
                    </a>
                    <a href="{{ route('categories.confirmDelete', $product) }}" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection
