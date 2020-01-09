@extends('layouts.app')

@section('content')
    <div class="container col-lg-9 col-md-12">
        <div class="d-flex justify-content-center">
            <h2 class="align-self-end text-center">{{__('Invoices')}}</h2>
        </div>

        <div class="card">
            @include('invoice.partials.__headerSearchBar')

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
                {!! $invoices->links() !!}
            </div>
        </div>
    </div>
@endsection
