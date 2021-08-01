@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('admin::resource.create', ['resource' => trans('user::roles.roles')])))
    
    <li class="nav-item"><a href="{{ route('admin.roles.index') }}">{{ clean(trans('user::roles.roles')) }}</a></li>
    <li class="separator"><i class="flaticon-right-arrow"></i></li>
    <li class="nav-item">{{ clean(trans('admin::resource.create', ['resource' => trans('user::roles.role')])) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12"> 
        <form method="POST" action="{{ route('admin.roles.store') }}" class="form-horizontal" id="role-create-form" novalidate>
            {{ csrf_field() }}

            {!! $tabs->render(compact('role')) !!}
        </form>
    </div>
</div>
@endsection