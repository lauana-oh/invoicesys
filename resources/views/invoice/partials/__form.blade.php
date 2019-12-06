<div class="form-row form-group">
    <div class="col-md-4">
        <label for="invoice_date">{{__('Invoice Date')}}:</label>
        <input type="date" name="invoice_date" id="invoice_date" class="form-control"
               value="{{old("invoice_date", $invoice->invoice_date)}}">
    </div>
    <div class="col-md-4">
        <label for="delivery_date">{{__('Delivery Date')}}:</label>
        <input type="date" name="delivery_date" id="delivery_date" class="form-control"
               value="{{old("delivery_date", $invoice->delivery_date)}}">
    </div>
    <div class="col-md-4">
        <label for="due_date">{{__('Due Date')}}:</label>
        <input type="date" name="due_date" id="due_date" class="form-control"
               value="{{old("due_date", $invoice->due_date)}}">
    </div>
</div>

<div class="form-row form-group">
    <div class="col-md-5">
        <label for="client">{{__('Client')}}:</label>
        <input list="clients" name="client" id="client" class="form-control"
               placeholder="Select a client" value="{{old("client", $invoice->client->name)}}">
        <datalist id="clients">
            @foreach($companies as $client)
                <option value="{{$client->name}}">NIT: {{$client->nit}}</option>
            @endforeach
        </datalist>
    </div>
    <div class="col-md-5">
        <label for="vendor">{{__('Vendor')}}:</label>
        <input list="vendors" name="vendor" id="vendor" class="form-control"
               placeholder="Select a vendor" value="{{old("vendor", $invoice->vendor->name)}}">
        <datalist id="vendors">
            @foreach($companies as $vendor)
                <option value="{{$vendor->name}}">NIT:{{$vendor->nit}}</option>
            @endforeach
        </datalist>
    </div>
    <div class="col-md-2">
        <label for="status_id">{{__('Status')}}:</label>
        <select class="form-control custom-select" name="status_id" id="status_id" required>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}" {{ old('status_id', $invoice->status_id) == $status->id ? 'selected' : ''}}>{{ $status->name }}</option>
            @endforeach
        </select>
    </div>
</div>


