<div class="row justify-content-xl-center mb-3">
    <table>
        <tr>
            <td class="col-auto"><strong>{{__('Due Date')}}:</strong> {{$invoice->due_date}}</td>
            <td class="col-auto"><strong>{{__('Delivery Date')}}:</strong> {{$invoice->delivery_date}}</td>
            <td class="col-auto"><strong>{{__('Invoice Date')}}:</strong> {{$invoice->invoice_date}}</td>
        </tr>
        <tr>
            <td class="col-auto"><strong>{{__('Total')}}:</strong>{{$invoice->totalPaidFormatted}}</td>
            <td class="col-auto"><strong>{{__('Status')}}: </strong>{{$invoice->status->name}}</td>
        </tr>
    </table>
</div>

<div class="row justify-content-center mb-3">
    <div class="col justify-content-center col-5 border">
        <ul class="list-unstyled">
            <li><strong>{{__('Client')}}:</strong> {{$invoice->client->name}}</li>
            <li><strong>{{__('NIT')}}:</strong> {{$invoice->client->nit}}</li>
            <li><strong>{{__('Email')}}:</strong> {{$invoice->client->email}}</li>
            <li><strong>{{__('Phone')}}:</strong> {{$invoice->client->phone}}</li>
            <li><strong>{{__('Address')}}:</strong> {{$invoice->client->address}}</li>
        </ul>
    </div>
    <div class="col col-auto"></div>
    <div class="col justify-content-center col-5 border">
        <ul class="list-unstyled ">
            <li><strong>{{__('Vendor')}}:</strong> {{$invoice->vendor->name}}</li>
            <li><strong>{{__('NIT')}}:</strong> {{$invoice->vendor->nit}}</li>
            <li><strong>{{__('Email')}}:</strong> {{$invoice->vendor->email}}</li>
            <li><strong>{{__('Phone')}}:</strong> {{$invoice->vendor->phone}}</li>
            <li><strong>{{__('Address')}}:</strong> {{$invoice->vendor->address}}</li>
        </ul>
    </div>
</div>

