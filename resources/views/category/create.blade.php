@extends('layouts.app')

@section('content')
    <div class="container col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">{{__('Creating new category')}}</div>

            <div class="card-body">
                <form action="{{route('categories.store', $category)}}" method="post" id="categories-form">
                    @csrf
                    @include('category.partials.__form')
                </form>

                <div class="container d-flex col-lg-6 col-sm justify-content-around">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success" form="categories-form">
                        <i class="fas 	fa fa-upload"></i> {{ __('Create') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
