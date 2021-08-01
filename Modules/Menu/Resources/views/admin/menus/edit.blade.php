@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('admin::resource.edit', ['resource' => trans('menu::menus.menu')])))
    @slot('subtitle', $menu->title)
    <li class="nav-item"><a href="{{ route('admin.menus.index') }}">{{ clean(trans('menu::menus.menus')) }}</a></li>
    <li class="separator"><i class="flaticon-right-arrow"></i></li>
    <li class="nav-item">{{ clean(trans('admin::resource.edit', ['resource' => trans('menu::menus.menu')])) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12"> 
        <form method="POST" action="{{ route('admin.menus.update', $menu) }}" class="form-horizontal" id="menu-edit-form" novalidate>
            {{ csrf_field() }}
            {{ method_field('put') }}

            {!! $tabs->render(compact('menu')) !!}
        </form>
    </div>
</div>
@endsection

@push('general')
    <script>
        CI.langs['menu::messages.menu_item_deleted'] = '{{ clean(trans('menu::messages.menu_item_deleted')) }}';
        CI.langs['menu::messages.menu_items_order_updated'] = '{{ clean(trans('menu::messages.menu_items_order_updated')) }}';
    </script>
@endpush
