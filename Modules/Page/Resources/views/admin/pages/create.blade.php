@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('admin::resource.create', ['resource' => trans('page::pages.page')])))
    
    <li class="nav-item"><a href="{{ route('admin.pages.index') }}">{{ clean(trans('page::pages.pages')) }}</a></li>
    <li class="separator"><i class="flaticon-right-arrow"></i></li>
    <li class="nav-item">{{ clean(trans('admin::resource.create', ['resource' => clean(trans('page::pages.page'))])) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12"> 
        <form method="POST" action="{{ route('admin.pages.store') }}" class="form-horizontal" id="page-create-form" novalidate>
            {{ csrf_field() }}

            {!! $tabs->render(compact('page')) !!}
        </form>
    </div>
</div>
@endsection


