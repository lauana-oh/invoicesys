@extends('layouts.app')

@section('content')
    <div class="container col-lg-9 col-md-12">
        <div class="d-flex justify-content-center">
            <h2 class="align-self-end text-center">{{__('Categories')}}</h2>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-around align-items-end">
                <div class="col-lg-4 col-sm-auto justify-content-center">
                    <a class="btn btn-primary" href="{{route('categories.create')}}">{{__('Add a new category')}}</a>
                </div>
                <div class="col-lg-5 col-sm-auto align-self-auto justify-content-center">
                    <form action="{{route('categories.search')}}" method="post" role="search">
                        @csrf
                        <div class="input-group md-form form-sm form-1 pl-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-search text-gray" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input aria-label="Search" class="form-control my-0 py-1" id="categorySearch"
                                   name="categorySearch" placeholder="Search" type="text">
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body container">
                <table class="table">
                    <tr class="row">
                        <th class="col col-1 text-center">{{__('ID')}}</th>
                        <th class="col">{{__('Category')}}</th>
                        <th class="col-6">{{__('Description')}}</th>
                        <th class="col text-center">{{__('IVA')}}</th>
                        <th class="col" ></th>
                    </tr>
                    @foreach($categories as $category)
                        @include('category.partials.__row')
                    @endforeach
                </table>
                {!! $categories->links() !!}
            </div>
        </div>
    </div>
@endsection
