<tr>
    <td class="text-center"><a href="{{ route('invoices.show', $invoice) }}">{{$invoice->id}}</a></td>
    <td>{{$invoice->client->name}}</td>
    <td class="text-center">{{$invoice->due_date}}</td>
    <td class="text-center">{{$invoice->totalPaidFormatted}}</td>
    <td class="text-center">{{$invoice->status->name}}</td>
    <td class="text-right">
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