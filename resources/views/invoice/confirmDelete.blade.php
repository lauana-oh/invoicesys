@extends('layouts.app')

@section('content')
@section('content')
    <div class="container">
        <div class="card w-75">
            <div class="card-header alert-dark">{{__('Showing details of')}} <strong>{{__('Invoice').$invoice->idFormatted}}</strong></div>
            <div class="card-body">
                @include('invoice.partials.__details')

                <div class="d-flex justify-content-around w-50">
                    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                    <a href="{{ route('invoices.destroy', $invoice->id) }}" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> {{ __('Confirm delete') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
