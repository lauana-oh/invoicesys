@extends('layouts.app')

@section('content')
    <div class="container col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">{{__('Editing category')}} {{$category->name}}</div>

            <div class="card-body">

                <form action="{{route('categories.update', $category)}}" method="post" class="form-group" id="categories-form">
                    @csrf
                    @method('put')
                    @include('category.partials.__form')
                </form>

                <div class="container d-flex col-lg-6 col-sm justify-content-around">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success" form="categories-form">
                        <i class="fas fa-edit"></i> {{ __('Update') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
