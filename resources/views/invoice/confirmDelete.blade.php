@extends('layouts.app')

@section('content')
    <div class="container col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header alert-dark">{{__('Showing details of')}} <strong>{{__('Invoice').$invoice->idFormatted}}</strong></div>
            <div class="card-body">
                @include('invoice.partials.__details')

                <div class="container d-flex col-lg-6 col-sm justify-content-around">
                    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                    <form action="{{route('invoices.destroy', $invoice->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-trash-alt"></i> {{ __('Confirm delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
