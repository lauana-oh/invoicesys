@extends('layouts.app')

@section('content')
    <div class="container col-lg-9 col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-end">
                <div class="col-lg-3 col-sm-auto">
                    <h4>{{__('Invoices')}}</h4>
                </div>
                <div class="col-lg-3 col-sm-auto align-self-auto">
                    <a class="btn btn-primary" href="{{route('invoices.create')}}">Add a new invoice</a>
                </div>
            </div>

            <div class="card-body container">
                <table class="table">
                    <tr class="row">
                        <th class="col-1 text-center">{{__('ID')}}</th>
                        <th class="col-3">{{__('Client')}}</th>
                        <th class="col text-center">{{__('Due Date')}}</th>
                        <th class="col text-center">{{__('Total')}}</th>
                        <th class="col text-center">{{__('Status')}}</th>
                        <th class=" col-1 text-center"></th>
                    </tr>
                    @foreach($invoices as $invoice)
                        @include('invoice.partials.__row')
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
