@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('admin::resource.create', ['resource' => trans('menu::menus.menu')])))
    
    <li class="nav-item"><a href="{{ route('admin.menus.index') }}">{{ clean(trans('menu::menus.menus')) }}</a></li>
    <li class="separator"><i class="flaticon-right-arrow"></i></li>
    <li class="nav-item">{{ clean(trans('admin::resource.create', ['resource' => trans('menu::menus.menu')])) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12"> 
        <form method="POST" action="{{ route('admin.menus.store') }}" class="form-horizontal" id="menu-create-form" novalidate>
            {{ csrf_field() }}
            {!! $tabs->render(compact('menu')) !!}
        </form>
    </div>
</div>
@endsection
