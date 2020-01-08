@extends('layouts.app')

@section('content')
    <div class="container col-lg-9 col-md-12">
        <div class="d-flex justify-content-center">
            <h2 class="align-self-end text-center">{{__('Invoices')}}</h2>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-around align-items-end">
                <div class="col-lg-4 col-sm-auto justify-content-center">
                    <a class="btn btn-primary" href="{{route('invoices.create')}}">{{__('Add a new invoice')}}</a>
                </div>
                <div class="col-lg-5 col-sm-auto align-self-auto justify-content-center">
                    <form action="{{route('invoices.search')}}" method="post" role="search">
                        @csrf
                        <div class="input-group md-form form-sm form-1 pl-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-search text-gray" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input aria-label="Search" class="form-control my-0 py-1" id="invoiceSearch"
                                   name="invoiceSearch" placeholder="Search" type="text">
                        </div>
                    </form>
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
                {!! $invoices->links() !!}
            </div>
        </div>
    </div>
@endsection
