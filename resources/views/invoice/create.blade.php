@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card w-75">
            <div class="card-header">{{__('Creating invoice')}}{{$invoice->idFormatted}}</div>

            <div class="card-body">
                <form action="{{route('invoices.store', $invoice->id)}}" method="post" class="form-group" id="invoices-form">
                    @csrf
                    @include('invoice.partials.__form')
                </form>
                <div class="d-flex justify-content-around w-50">
                    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success" form="invoices-form">
                        <i class="fas fa-edit"></i> {{ __('Update') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
