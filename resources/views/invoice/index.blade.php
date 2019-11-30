@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card w-75">
            <div class="card-header">{{__('Invoices')}}</div>

            <div class="card-body">
                <div class="row">
                    <a class="btn btn-primary mb-4 ml-2" href="{{route('invoices.create')}}">Add a new invoice</a>
                </div>
                <div class="row">
                    <table class="table">
                        <tr>
                            <th class="text-center">{{__('ID')}}</th>
                            <th class="w-25">{{__('Client')}}</th>
                            <th class="text-center">{{__('Due Date')}}</th>
                            <th class="text-center">{{__('Total')}}</th>
                            <th class="text-center">{{__('Status')}}</th>
                            <th class="text-right"></th>
                        </tr>
                        @foreach($invoices as $invoice)
                            @include('invoice.partials.__row')
                        @endforeach
                    </table>
                </div>
        </div>
    </div>
</div>
@endsection
