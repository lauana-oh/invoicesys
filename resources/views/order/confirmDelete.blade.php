@extends('layouts.app')

@section('content')
    <div class="container col-lg-6 col-md-8">
        <div class="card">
            <div class="card-header alert-dark">
                {{__('Delete')}}
                <strong>{{__('Order').$order->idFormatted}} - {{$invoice->idFormatted}}?</strong>
            </div>
            <div class="card-body pl-5">
                @include('order.partials.__details')

                <div class="container d-flex col-lg-6 col-sm justify-content-around">
                    <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                    <form action="{{route('orders.destroy', compact('invoice','order'))}}" method="post">
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