@extends('layouts.app')

@section('content')
<div class="container col-lg-10 col-md-12">
    <div class="card">
        <div class="card-header alert-dark">{{__('Showing details of')}} <strong>{{__('Invoice').$invoice->idFormatted}}</strong></div>
        <div class="card-body">
            @include('invoice.partials.__details')

            <div class="container d-flex col-lg-6 col-sm justify-content-around">
                <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                </a>
                <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                </a>
                <a href="{{ route('invoices.confirmDelete', $invoice->id) }}" class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                </a>
            </div>
        </div>

        @include('order.partials.__index')
    </div>
</div>
@endsection
