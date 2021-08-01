@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('admin::resource.edit', ['resource' => trans('user::users.user')])))
    @slot('subtitle', $user->full_name)
    <li class="nav-item"><a href="{{ route('admin.users.index') }}">{{ clean(trans('user::users.users')) }}</a></li>
    <li class="separator"><i class="flaticon-right-arrow"></i></li>
    <li class="nav-item">{{ clean(trans('admin::resource.edit', ['resource' => trans('user::users.user')])) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="form-horizontal" id="user-edit-form" novalidate>
            {{ csrf_field() }}
            {{ method_field('put') }}

            {!! $tabs->render(compact('user')) !!}
        </form>
    </div>
</div>
@endsection