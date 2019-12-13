@extends('layouts.app')

@section('content')
    <div class="container col-lg-6 col-md-8">
        <div class="card">
            <div class="card-header alert-dark">
                {{__('Showing details of')}}
                <strong>{{__('Order').$order->idFormatted}} - {{$invoice->idFormatted}}</strong>
            </div>

            <div class="card-body">
                @include('order.partials.__details')

                <div class="container d-flex col-lg-6 col-sm justify-content-around">
                    <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                    <a href="{{ route('orders.edit', compact('invoice', 'order')) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> {{ __('Edit') }}
                    </a>
                    <a href="{{ route('orders.confirmDelete', compact('invoice','order')) }}" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection