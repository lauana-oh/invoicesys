@extends('layouts.app')

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
                <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                </a>
                <a href="{{ route('invoices.confirmDelete', $invoice->id) }}" class="btn btn-danger">
                    <i class="fas fa-arrow-left"></i> {{ __('Delete') }}
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header navbar-nav">
                <table>
                    <tr>
                        <th class="col w-75">{{__('Order details of invoice')}}</th>
                        <th class="col"><a class="btn btn-link" href="{{route("orders.create", $invoice->id)}}">+ Add product</a></th>
                    </tr>
                </table>
            </div>

            <div class="card-body">
                <div class="row">
                    <table class="table">
                        <tr>
                            <th class="text-center">Quantity</th>
                            <th class="w-25">Product</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Total Price</th>
                            <th class="text-center">IVA</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($orders as $order)
                            <tr>
                                <td class="text-center">{{$order->quantityFormatted}}</td>
                                <td><a href="{{route("orders.show", [$invoice->id, $order->id])}}">{{$order->product->name}}</a></td>
                                <td class="text-center">{{$order->unitPriceFormatted}}</td>
                                <td class="text-center">{{$order->totalPriceFormatted}} </td>
                                <td class="text-center">{{$order->productIvaFormatted}}</td>
                                <td class="text-center"><a href="{{route("orders.edit", [$invoice->id, $order->id])}}">Edit</a></td>
                                <td class="text-center"><a href="{{route("orders.confirmDelete", [$invoice->id, $order->id])}}">Delete</a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
