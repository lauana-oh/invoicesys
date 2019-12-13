<div class="row">
    <div class="col">
        <ul class="list-unstyled">
            <li><strong>Order:</strong>{{$order->idFormatted}}</li>
            <li><strong>Invoice:</strong>{{$order->invoice->idFormatted}}</li>
            <li><strong>Product:</strong> {{$order->product->name}}</li>
            <li><strong>Category:</strong> {{$order->product->category->name}}</li>
            <li><strong>Unit price:</strong>{{$order->unitPriceFormatted}}</li>
        </ul>
    </div>
    <div class="col">
        <ul class="list-unstyled">
            <li><strong>Quantity:</strong> {{$order->quantityFormatted}}</li>
            <li><strong>Total price:</strong>{{$order->totalPriceFormatted}}</li>
            <li><strong>Iva:</strong> {{$order->productIvaFormatted}}</li>
            <li><strong>Iva paid:</strong> {{$order->productIvaPaidFormatted}}</li>
        </ul>
    </div>
</div>
