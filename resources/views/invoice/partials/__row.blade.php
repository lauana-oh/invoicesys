<tr class="row">
    <td class="col-1 text-center"><a href="{{ route('invoices.show', $invoice) }}">{{$invoice->id}}</a></td>
    <td class="col-3">{{$invoice->client->name}}</td>
    <td class=" col text-center">{{$invoice->due_date}}</td>
    <td class=" col text-center">{{$invoice->delivery_date}}</td>
    <td class=" col text-center">{{$invoice->invoice_date}}</td>
    <td class="col text-center">{{$invoice->totalPaidFormatted}}</td>
    <td class="col text-center">{{$invoice->status->name}}</td>
    <td class="col-1 text-left">
        <div class="btn-group btn-group-sm" role="group" aria-label="{{ __('invoices actions') }}">
            <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-link" title="{{ __('Edit') }}">
                <i class="fas fa-edit"></i>
            </a>
            <a href="{{ route('invoices.confirmDelete', $invoice) }}" class="btn btn-link text-danger" title="{{ __('Delete') }}">
                <i class="fas fa-trash"></i>
            </a>
        </div>
    </td>
</tr>