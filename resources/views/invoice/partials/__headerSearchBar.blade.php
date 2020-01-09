<div class="card-header d-flex justify-content-around align-items-end">

    <div class="col-lg-4 col-sm-auto justify-content-center">
        <a class="btn btn-primary" href="{{route('invoices.create')}}">{{__('Add a new invoice')}}</a>
    </div>

    <div class="col-lg-5 col-sm-auto align-self-auto justify-content-center">
        <form action="{{route('invoices.search')}}" method="post" role="search">
            @csrf
            <div class="input-group md-form form-sm form-1 pl-0">
                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-search text-gray" aria-hidden="true"></i>
                                </span>
                </div>
                <input aria-label="Search" class="form-control my-0 py-1" id="invoiceSearch"
                       name="invoiceSearch" placeholder="Search" type="text">
                <a aria-controls="collapseFilter" aria-expanded="false" class="btn btn-primary mx-1" data-toggle="collapse"
                   href="#collapseFilter" role="button">+</a>
            </div>
        </form>
    </div>
</div>

<div class="collapse" id="collapseFilter">
    <div class="card card-body">
        <h3 class="pl-5">Filters</h3>
        <form action="{{route('invoices.filter')}}" method="post" role="search">
            @csrf
            @include('invoice.partials.__filter')
        </form>
    </div>
</div>
