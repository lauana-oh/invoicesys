<tr class="row w-75">
    <td class="col text-center">{{$category->id}}</td>
    <td class="col-2"><a href="{{route('categories.show', $category)}}">{{$category->name}}</a></td>
    <td class="col-5 text-truncate">{{$category->description}}</td>
    <td class="col text-center">{{$category->iva}} %</td>
    <td class="col">
        <div class="btn-group btn-group-sm" role="group" aria-label="{{ __('categories actions') }}">
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-link" title="{{ __('Edit') }}">
                <i class="fas fa-edit"></i>
            </a>
            <a href="{{ route('categories.confirmDelete', $category) }}" class="btn btn-link text-danger" title="{{ __('Delete') }}">
                <i class="fas fa-trash"></i>
            </a>
        </div>
    </td>
</tr>
