@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('admin::resource.create', ['resource' => trans('slider::sliders.slider')])))
    
    <li class="nav-item"><a href="{{ route('admin.sliders.index') }}">{{ clean(trans('slider::sliders.sliders')) }}</a></li>
    <li class="separator"><i class="flaticon-right-arrow"></i></li>
    <li class="nav-item">{{ clean(trans('admin::resource.create', ['resource' => trans('slider::sliders.slider')])) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12"> 
        <form method="POST" action="{{ route('admin.sliders.store') }}" class="form-horizontal" id="slider-create-form" novalidate>
            {{ csrf_field() }}

            {!! $tabs->render(compact('slider')) !!}
        </form>
    </div>
</div>
@endsection
