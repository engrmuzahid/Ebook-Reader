@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('admin::resource.edit', ['resource' => trans('slider::sliders.slider')])))
    @slot('subtitle', $slider->name)
    <li class="nav-item"><a href="{{ route('admin.sliders.index') }}">{{ clean(trans('slider::sliders.sliders')) }}</a></li>
    <li class="separator"><i class="flaticon-right-arrow"></i></li>
    <li class="nav-item">{{ clean(trans('admin::resource.edit', ['resource' => trans('slider::sliders.slider')])) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('admin.sliders.update', $slider) }}" class="form-horizontal" id="slider-edit-form" novalidate>
            {{ csrf_field() }}
            {{ method_field('put') }}

            {!! $tabs->render(compact('slider')) !!}
        </form>
    </div>
</div>
@endsection
    
