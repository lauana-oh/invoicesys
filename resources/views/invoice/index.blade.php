@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Invoices</div>

                <div class="card-body">
                    <div class="row">
                        <a class="btn btn-primary mb-4 ml-2" href="/invoices/create">Add a new invoice</a>
                    </div>
                    <div class="row">
                        <table class="table">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="w-25">Client</th>
                                <th class="text-center">Due Date</th>
                                <th class="text-center">Invoice Date</th>
                                <th class="text-center">Delivery Date</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td class="text-center">{{$invoice->id}}</td>
                                    <td><a href="/invoices/{{$invoice->id}}">{{$invoice->client_id}}</a></td>
                                    <td class="text-center">{{$invoice->due_date}}</td>
                                    <td class="text-center">{{$invoice->invoice_date}} </td>
                                    <td class="text-center">{{$invoice->delivery_date}}</td>
                                    <td class="text-center"><a href="/invoices/{{$invoice->id}}/edit">Edit</a></td>
                                    <td class="text-center"><a href="/invoices/{{$invoice->id}}/confirmDelete">Delete</a> </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
