@extends('layouts.app')

@section('content')
    <div class="container col-lg-9 col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-end">
                <div class="col-lg-3 col-sm-auto">
                    <h4>{{__('Invoices')}}</h4>
                </div>
                <div class="col-lg-3 col-sm-auto align-self-auto">
                    <a class="btn btn-primary" href="{{route('invoices.create')}}">{{__('Add a new invoice')}}</a>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseImport">
                        <strong>+</strong>
                    </button>
                </div>
            </div>
            <div class="collapse" id="collapseImport">
                <div class="card-body d-flex justify-content-around col-8">
                    <div class="col">
                        <form action="{{ route('invoices.import') }}" enctype="multipart/form-data"
                              method="post">
                            @csrf
                            <div class="form-group">
                                <label for="importInvoicesFile">{{__('Import invoices file')}}</label>
                                    <input type="file" class="form-control-file" id="importInvoicesFile" name="importInvoicesFile">
                            </div>
                            <button type="submit" class="btn btn-outline-primary py-2">{{__('Submit')}}</button>
                        </form>
                    </div>
                    <div class="col text-right">
                        <h6>Export invoices</h6>
                        <a href="{{ route('invoices.export') }}" class="btn btn-outline-primary"> Export </a>
                    </div>
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
