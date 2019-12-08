<div class="row">
    <div class="form-group col">
        <div class="">
            <label for="name">{{__('Category name')}}:</label>
            <input type="text" class="form-control mb-3" id="name" name="name"
                   placeholder="Type a new category" value="{{old("name",$category->name)}}">
            @error('name')<div class="alert alert-danger small p-1 text-center">{{ $message }}</div>@enderror
        </div>

        <div class="">
            <label for="iva">{{__('IVA')}}:</label>
            <div class="input-group">
                <input type="number" class="form-control" id="iva" value="{{old("iva",$category->iva)}}"
                       placeholder="Type the corresponded iva of this category" name="iva" step="0.1">
                <div class="input-group-append">
                    <div class="input-group-text">%</div>
                </div>
            </div>
            @error('iva')<div class="alert alert-danger small p-1 text-center">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="form-group col">
        <div class="">
            <label for="description">{{__('Description')}}:</label>
            <textarea class="form-control"  name="description" rows="5"
                      id="description" placeholder="Describe this new category...">{{old("description",$category->description)}}
        </textarea>
            @error('description')<div class="alert alert-danger small p-1 text-center">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
