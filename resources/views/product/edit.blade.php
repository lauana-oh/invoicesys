@extends('layouts.app')

@section('content')
    <div class="container col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">{{__('Editing product')}} {{$product->name}}</div>

            <div class="card-body">

                <form action="{{route('products.update', $product)}}" method="post" class="form-group" id="products-form">
                    @csrf
                    @method('put')
                    @include('product.partials.__form')
                </form>

                <div class="container d-flex col-lg-6 col-sm justify-content-around">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success" form="products-form">
                        <i class="fas fa-edit"></i> {{ __('Update') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
