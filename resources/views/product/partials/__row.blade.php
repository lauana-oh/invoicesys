<tr class="row">
    <td class=" col text-center">{{$product->id}}</td>
    <td class="col-3"><a href="{{route('products.show', $product)}}">{{$product->name}}</a></td>
    <td class="col-2 text-center">{{$product->unitPriceFormatted}}</td>
    <td class="col-2 text-center">{{$product->stockFormatted}} </td>
    <td class="col-2 text-center">{{$product->category->name}}</td>
    <td class="col text-left">
        <div class="btn-group btn-group-sm" role="group" aria-label="{{ __('products actions') }}">
            <a href="{{ route('products.edit', $product) }}" class="btn btn-link" title="{{ __('Edit') }}">
                <i class="fas fa-edit"></i>
            </a>
            <a href="{{ route('products.confirmDelete', $product) }}" class="btn btn-link text-danger" title="{{ __('Delete') }}">
                <i class="fas fa-trash"></i>
            </a>
        </div>
    </td>
</tr>