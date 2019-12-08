<div class="row">
    <div class="col">

        <div class="form-group">
            <label for="name">Product name:</label>
            <input class="form-control " id="name" name="name" placeholder="Type your product name" type="text"
                   value="{{ old("name", $product->name) }}">
            @error('name')<div class="alert alert-danger small p-1 text-center">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" placeholder="Describe your product"
                      rows="4">{{old("description", $product->description) }}</textarea>
            @error('description')<div class="alert alert-danger small p-1 text-center">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col">

        <div class="form-group">
            <label for="unit_price">Unit price:</label>
            <input class="form-control" id="unit_price" name="unit_price" placeholder="$ 00.00"
                   step="0.01" type="number" value="{{ old("unit_price",$product->unit_price) }}">
            @error('unit_price')<div class="alert alert-danger small p-1 text-center">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="stock">Units in stock:</label>
            <input class="form-control" id="stock" name="stock" placeholder="000" step="1"
                   type="number" value="{{old("stock", $product->stockFormatted)}}">
            @error('stock')<div class="alert alert-danger small p-1 text-center">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="category">Category:</label>
            <input class="form-control" id="category" list="categories" name="category"
                   value="{{$product->category->name}}" placeholder="Select a category">
            <datalist id="categories">
                @foreach($categories as $category)
                    <option value="{{$category->name}}">
                @endforeach
            </datalist>
            @error('category')<div class="alert alert-danger small p-1 text-center">{{ $message }}</div>@enderror
        </div>

    </div>
</div>