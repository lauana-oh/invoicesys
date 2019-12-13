@extends('layouts.app')

@section('content')
    <div class="container jumbotron jumbotron-fluid">
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md display-2 d-flex justify-content-center">
                    InvoiceSys
                </div>

                <div class="links d-flex justify-content-center p-4">
                        <a href="{{route('invoices.index')}}" class="px-4 h3">Invoices</a>
                        <a href="{{route('companies.index')}}" class="px-4 h3">Companies</a>
                        <a href="{{route('products.index')}}" class="px-4 h3">Products</a>
                        <a href="{{route('categories.index')}}" class="px-4 h3">Categories</a>
                </div>
            </div>
        </div>
    </div>
@endsection
