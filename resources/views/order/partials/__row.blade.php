<tr class="row">
    <td class=" col-2 text-center">{{$order->quantityFormatted}}</td>
    <td class="col"><a href="{{route("orders.show", [$invoice->id, $order->id])}}">{{$order->product->name}}</a></td>
    <td class="col-2 text-center">{{$order->unitPriceFormatted}}</td>
    <td class="col-2 input-group justify-content-between">
        <div>{{$order->ProductIvaPaidFormatted}}</div>
        <div class="text-left pr-lg-4">{{$order->productIvaFormatted}}</div>
    </td>
    <td class="col-2 pl-lg-5">{{$order->totalPriceFormatted}} </td>
    <td class="col-1 text-left">
        <div class="btn-group btn-group-sm" role="group" aria-label="{{ __('orders actions') }}">
            <a href="{{ route('orders.edit', compact('invoice', 'order'))}}" class="btn btn-link" title="{{ __('Edit') }}">
                <i class="fas fa-edit"></i>
            </a>
            <a href="{{ route('orders.confirmDelete',  compact('invoice', 'order'))}}" class="btn btn-link text-danger" title="{{ __('Delete') }}">
                <i class="fas fa-trash"></i>
            </a>
        </div>
    </td>
</tr>