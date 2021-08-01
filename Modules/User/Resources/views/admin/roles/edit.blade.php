@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('admin::resource.edit', ['resource' => trans('user::roles.role')])))
    @slot('subtitle', $role->name)
    
    <li class="nav-item"><a href="{{ route('admin.roles.index') }}">{{ clean(trans('user::roles.roles')) }}</a></li>
    <li class="separator"><i class="flaticon-right-arrow"></i></li>
    <li class="nav-item">{{ clean(trans('admin::resource.edit', ['resource' => trans('user::roles.role')])) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12"> 
        <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="form-horizontal" id="role-edit-form" novalidate>
            {{ csrf_field() }}
            {{ method_field('put') }}

            {!! $tabs->render(compact('role')) !!}
        </form>
    </div>
</div>
@endsection