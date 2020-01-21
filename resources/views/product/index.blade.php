@extends('layouts.app')

@section('content')
    <div class="container col-lg-9 col-md-12">
        <div class="d-flex justify-content-center">
            <h2 class="align-self-end text-center">{{__('Products')}}</h2>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-around align-items-end">
                <div class="col-lg-4 col-sm-auto justify-content-center">
                    <a class="btn btn-primary" href="{{route('products.create')}}">{{__('Add a new product')}}</a>
                </div>
                <div class="col-lg-5 col-sm-auto align-self-auto justify-content-center">
                    <form action="{{route('products.search')}}" method="post" role="search">
                        @csrf
                        <div class="input-group md-form form-sm form-1 pl-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-search text-gray" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input aria-label="Search" class="form-control my-0 py-1" id="productSearch"
                                   name="productSearch" placeholder="Search" type="text">
                        </div>
                    </form>
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
                {!! $products->links() !!}
            </div>
        </div>
    </div>
@endsection
