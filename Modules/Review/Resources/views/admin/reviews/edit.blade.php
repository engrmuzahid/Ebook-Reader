@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('admin::resource.edit', ['resource' => trans('review::reviews.review')])))
    
    <li class="nav-item"><a href="{{ route('admin.reviews.index') }}">{{ clean(trans('review::reviews.reviews')) }}</a></li>
    <li class="separator"><i class="flaticon-right-arrow"></i></li>
    <li class="nav-item">{{ clean(trans('admin::resource.edit', ['resource' => trans('review::reviews.review')])) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('admin.reviews.update', $review) }}" class="form-horizontal" id="review-edit-form" novalidate>
            {{ csrf_field() }}
            {{ method_field('put') }}

            {!! $tabs->render(compact('review')) !!}
        </form>
    </div>
</div>
@endsection