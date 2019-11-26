@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header alert-dark">Delete {{$invoice->name}}?</div>

                <div class="card-body">
                    <div class="row">
                        @if($errors->any())
                            <div class="alert alert-dark">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <ul>
                            <li><strong>ID:</strong> {{$invoice->idFormatted}}</li>
                            <li><strong>Client:</strong> {{$invoice->client->name}}</li>
                            <li><strong>Vendor:</strong> {{$invoice->vendor->name}}</li>
                            <li><strong>Invoice Date:</strong> {{$invoice->invoice_date}}</li>
                            <li><strong>Delivery Date:</strong> {{$invoice->delivery_date}}</li>
                            <li><strong>Due Date:</strong> {{$invoice->due_date}}</li>
                        </ul>
                    </div>
                    <div class="row ">
                        <form action="/invoices/{{$invoice->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-primary m-2 alert-danger" type="submit">Delete</button>
                        </form>

                        <a class="btn btn-secondary m-2" href="/invoices/">Back</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
