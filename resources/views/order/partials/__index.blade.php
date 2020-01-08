<div class="card">
    <div class="card-header navbar-nav">
        <table>
            <tr class="row align-items-center">
                <th class="col">{{__('Order details of invoice')}}</th>
                <th class="col-3 text-center"><a class="btn btn-link" href="{{route("orders.create", $invoice->id)}}">+ Add product</a></th>
            </tr>
        </table>
    </div>
</div>
<div class="card-body container">
    <table class="table">
        <tr class="row">
            <th class="col-2 text-center">Quantity</th>
            <th class="col">Product</th>
            <th class="col-2 text-center">Unit Price</th>
            <th class="col-2 pl-lg-4">IVA</th>
            <th class="col-2 pl-lg-5">Total Price</th>
            <th class="col-1 text-center"></th>
        </tr>
        @foreach($orders as $order)
            @include('order.partials.__row')
        @endforeach
        <tr class="row alert-info">
            <td class=" col-2"></td>
            <td class="col"><strong>Subtotal</strong></td>
            <th class="col-2 text-center"><strong> - </strong></th>
            <td class="col-2 input-group justify-content-start">
                <div><strong>{{$invoice->totalIvaPaidFormatted}}</strong></div>
                <div class="pl-5"><strong>  </strong></div>
            </td>
            <td class="col-2 pl-lg-5"> <strong>{{$invoice->subtotalFormatted}}</strong></td>
            <td class="col-1">
        </tr>
        <tr class="row alert-dark">
            <td class="col-9 text-right"><strong>Total</strong></td>
            <td class="col-2 pl-lg-5"><strong>{{$invoice->totalPaidFormatted}}</strong></td>
            <td class="col-1"></td>
        </tr>
    </table>
</div>
