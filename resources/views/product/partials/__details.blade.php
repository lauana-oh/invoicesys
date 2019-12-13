<div class="row px-4">
    <div class="col-7">
        <ul class="list-unstyled">
            <li><strong>ID:</strong> {{$product->idFormatted}}</li>
            <li><strong>Name:</strong> {{$product->name}}</li>
            <li><strong>Description:</strong> {{$product->description}}</li>
        </ul>
    </div>

    <div class="col">
        <ul class="list-unstyled">
            <li><strong>Unit price:</strong> {{$product->unitPriceFormatted}}</li>
            <li><strong>Stock:</strong> {{$product->stockFormatted}}</li>
            <li><strong>Category:</strong> {{$product->category->name}}</li>
            <li><strong>Iva:</strong> {{$product->category->ivaFormatted}}</li>
        </ul>
    </div>
</div>