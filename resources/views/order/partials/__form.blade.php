<div class="form-row form-group">
    <div class="col col-3">
        <label for="quantity">Quantity:</label>
        <input type="number" class="form-control" id="quantity" name="quantity" step="1"
               value="{{ old("quantity", $order->quantity) }}" placeholder="000">
        @error('quantity')
            <div class="alert alert-danger small p-1 text-center">{{ $message }}</div>
        @enderror
    </div>

    <div class="col col-9">
        <label for="product">Product:</label>
        <input list="products" name="product" id="product" class="form-control"
               placeholder="Select product" value="{{ old("product",$order->product->name) }}">
        <datalist id="products">
            @foreach($products as $product)
                <option value="{{ $product->name }}">
            @endforeach
        </datalist>
        @error('product')
            <div class="alert alert-danger small p-1 text-center">{{ $message }}</div>
        @enderror
    </div>
</div>

<input type="hidden" id="invoice_id" name="invoice_id" value="{{$invoice->id}}">

