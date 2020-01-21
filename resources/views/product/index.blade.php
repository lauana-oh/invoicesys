@extends('layouts.app')

@section('content')
    <div class="container col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-end">
                <div class="col-lg-3 col-sm-auto">
                    <h4>{{__('Products')}}</h4>
                </div>
                <div class="col-lg-3 col-sm-auto align-self-auto">
                    <a class="btn btn-primary" href="{{route('products.create')}}">{{__('Add a new product')}}</a>
                </div>
            </div>

            <div class="card-body justify-content-center">
                <table class="table">
                    <tr class="row">
                        <th class=" col text-center">{{__('ID')}}</th>
                        <th class="col-3">{{__('Product')}}</th>
                        <th class=" col-2 text-center">{{__('Unit Price')}}</th>
                        <th class="col-2 text-center">{{__('Quantity in stock')}}</th>
                        <th class="col-2 text-center">{{__('Category')}}</th>
                        <th class="col"></th>
                    </tr>
                    @foreach($products as $product)
                        @include('product.partials.__row')
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
