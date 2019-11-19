@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Invoice</div>

                <div class="card-body">
                    <div class="row">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="row justify-content-center">
                        <form action="/invoices/{{$invoice->id}}" method="post" class="form-group">
                            @csrf
                            @method('put')
                            <div class="form-row form-group">
                                <div class="col">
                                    <label for="invoice_date">Invoice Date</label>
                                    <input type="date" name="invoice_date" id="invoice_date" class="form-control"
                                           value="{{old("invoice_date", $invoice->invoice_date)}}">
                                </div>
                                <div class="col">
                                    <label for="delivery_date">Delivery Date</label>
                                    <input type="date" name="delivery_date" id="delivery_date" class="form-control"
                                           value="{{old("delivery_date", $invoice->delivery_date)}}">
                                </div>
                                <div class="col">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" name="due_date" id="due_date" class="form-control"
                                           value="{{old("due_date", $invoice->due_date)}}">
                                </div>
                            </div>

                            <class class="form-row form-group">
                                <div class="col">
                                    <label for="client_id">Client</label>
                                    <input type="number" name="client_id" id="client_id" class="form-control"
                                           value="{{old("client_id", $invoice->client_id)}}">
                                </div>
                            </class>

                            <class class="form-row form-group">
                                <div class="col">
                                    <label for="vendor_id">Vendor</label>
                                    <input type="number" name="vendor_id" id="vendor_id" class="form-control"
                                           value="{{old("vendor_id", $invoice->vendor_id)}}">
                                </div>
                            </class>

                            <div>
                                <button class="btn btn-primary form-control mt-2" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="row pt-2 justify-content-center" >
                        <a class="btn btn-secondary" href="/invoices">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
