<div class="card-header d-flex justify-content-around align-items-end">

    <div class="col-lg-4 col-sm-auto justify-content-center">
        <a class="btn btn-primary" href="{{route('invoices.create')}}">{{__('Add a new invoice')}}</a>
    </div>

    <div class="col-lg-5 col-sm-auto align-self-auto justify-content-center">
        <form action="{{route('invoices.index')}}" method="get" role="search">
            <div class="input-group md-form form-sm form-1 pl-0">
                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-search text-gray" aria-hidden="true"></i>
                                </span>
                </div>
                <input aria-label="Search" class="form-control my-0 py-1" id="invoiceSearch"
                       name="filter[search]" placeholder="Search" value="{{ request()->input('filter.search') }}" type="text">
                <a aria-controls="collapseFilter" aria-expanded="false" class="btn btn-primary mx-1" data-toggle="collapse"
                   href="#collapseFilter" role="button">+</a>
            </div>
        </form>
    </div>
</div>

<div class="collapse" id="collapseFilter">
    <div class="card card-body">
        <h3 class="pl-5">Filters</h3>
        <form action="{{route('invoices.index')}}" method="get" role="search" id="invoicesFilter">
            @include('invoice.partials.__filter')
        </form>
        <button type="submit" class="btn btn-secondary col-3 align-self-end" form="invoicesFilter">
            <i class="fas 	fa fa-search"></i> {{ __('Search') }}
        </button>
    </div>
    <div class="card-body d-flex justify-content-around col-8">
        <div class="col">
            <form action="{{ route('invoices.import') }}" enctype="multipart/form-data"
                  method="post">
                @csrf
                <div class="form-group">
                    <label for="importInvoicesFile">{{__('Import invoices file')}}</label>
                    <input type="file" class="form-control-file" id="importInvoicesFile" name="importInvoicesFile">
                </div>
                <button type="submit" class="btn btn-outline-primary py-2">{{__('Submit')}}</button>
            </form>
        </div>
        <div class="col text-right">
            <h6>Export invoices</h6>
            <a href="{{ route('invoices.export') }}" class="btn btn-outline-primary"> Export </a>
        </div>
    </div>
</div>
