<div class="container">
    <div class="row align-items-center mb-3">
        <div class="col text-center">
            <h1>Sales Invoice</h1>
        </div>
        <div class="col-6">
            <div class="list-unstyled">
                <li><strong>{{__('Due Date')}}:</strong> {{$invoice->due_date}}</li>
                <li><strong>{{__('Delivery Date')}}:</strong> {{$invoice->delivery_date}}</li>
                <li><strong>{{__('Invoice Date')}}:</strong> {{$invoice->invoice_date}}</li>
                <li><strong>{{__('Status')}}:</strong> {{$invoice->status->name}}</li>
                <li><strong>{{__('Total')}}:</strong> {{$invoice->totalPaidFormatted}}</li>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col justify-content-center col-5 border pt-3 pl-4">
            <ul class="list-unstyled">
                <li><strong>{{__('Client')}}:</strong> {{$invoice->client->name}}</li>
                <li><strong>{{__('NIT')}}:</strong> {{$invoice->client->nit}}</li>
                <li><strong>{{__('Email')}}:</strong> {{$invoice->client->email}}</li>
                <li><strong>{{__('Phone')}}:</strong> {{$invoice->client->phone}}</li>
                <li><strong>{{__('Address')}}:</strong> {{$invoice->client->address}}</li>
            </ul>
        </div>
        <div class="col col-auto"></div>
        <div class="col justify-content-center col-5 border pt-3 pl-4">
            <ul class="list-unstyled ">
                <li><strong>{{__('Vendor')}}:</strong> {{$invoice->vendor->name}}</li>
                <li><strong>{{__('NIT')}}:</strong> {{$invoice->vendor->nit}}</li>
                <li><strong>{{__('Email')}}:</strong> {{$invoice->vendor->email}}</li>
                <li><strong>{{__('Phone')}}:</strong> {{$invoice->vendor->phone}}</li>
                <li><strong>{{__('Address')}}:</strong> {{$invoice->vendor->address}}</li>
            </ul>
        </div>
    </div>
</div>

