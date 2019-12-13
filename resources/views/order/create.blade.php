@extends('layouts.app')

@section('content')

    <div class="container col-lg-7 col-md-12">
        <div class="card">
            <div class="card-header">Create a new order item</div>

            <div class="card-body">

                <form action="/invoices/{{$invoice->id}}/orders" method="post" class="form-group" id="orders-form">
                    @csrf
                    @include('order.partials.__form')
                </form>

                <div class="container d-flex col-lg-6 col-sm justify-content-around">
                    <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success" form="orders-form">
                        <i class="fas 	fa fa-upload"></i> {{ __('Create') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
