@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('admin::resource.create', ['resource' => trans('menu::menu_items.menu_item')])))
    
    <li class="nav-item"><a href="{{ route('admin.menus.index') }}">{{ clean(trans('menu::menus.menus')) }}</a></li>
    <li class="separator"><i class="flaticon-right-arrow"></i></li>
    <li class="nav-item"><a href="{{ route('admin.menus.edit', $menuId) }}">{{ clean(trans('admin::resource.edit', ['resource' => trans('menu::menus.menu')])) }}</a></li>
    <li class="separator"><i class="flaticon-right-arrow"></i></li>
    <li class="nav-item">{{ clean(trans('admin::resource.create', ['resource' => trans('menu::menu_items.menu_item')])) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('admin.menus.items.store', $menuId) }}" class="form-horizontal" id="menu-item-create-form" novalidate>
            {{ csrf_field() }}

            {!! $tabs->render(compact('menuId', 'menuItem')) !!}
        </form>
    </div>
</div>
@endsection

