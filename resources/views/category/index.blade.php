@extends('layouts.app')

@section('content')
    <div class="container col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-end">
                <div class="col-lg-3 col-sm-auto">
                    <h4>{{__('Categories')}}</h4>
                </div>
                <div class="col-lg-4 col-sm-auto align-self-auto">
                    <a class="btn btn-primary" href="{{route('categories.create')}}">{{__('Add a new category')}}</a>
                </div>
            </div>

            <div class="card-body container">
                <table class="table">
                    <tr class="row w-75">
                        <th class="col text-center">{{__('ID')}}</th>
                        <th class="col-2">{{__('Category')}}</th>
                        <th class="col-5">{{__('Description')}}</th>
                        <th class="col text-center">{{__('IVA')}}</th>
                        <th class="col"></th>
                    </tr>
                    @foreach($categories as $category)
                        @include('category.partials.__row')
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
