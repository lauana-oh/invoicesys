<tr class="row">
    <td class="col-1 text-center">{{$category->id}}</td>
    <td class="col"><a href="{{route('categories.show', $category)}}">{{$category->name}}</a></td>
    <td class="col-6">{{$category->description}}</td>
    <td class="col text-center">{{$category->ivaFormatted}}</td>
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
