<tr class="row align-content-center">
    <td class="col-4 pl-5"><a href="/companies/{{$company->id}}">{{$company->name}}</a></td>
    <td class="col-2">{{$company->nit}}</td>
    <td class="col">{{$company->address}}</td>
    <td class="col-2 text-center">
        <div class="btn-group btn-group-sm" role="group" aria-label="{{ __('companies actions') }}">
            <a href="{{ route('companies.edit', $company) }}" class="btn btn-link" title="{{ __('Edit') }}">
                <i class="fas fa-edit"></i>
            </a>
            <a href="{{ route('companies.confirmDelete', $company) }}" class="btn btn-link text-danger" title="{{ __('Delete') }}">
                <i class="fas fa-trash"></i>
            </a>
        </div>
    </td>
</tr>
