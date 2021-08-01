@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('admin::resource.edit', ['resource' => trans('user::users.profile')])))
    @slot('subtitle', clean($currentUser->full_name))
    <li class="nav-item">{{ clean(trans('admin::resource.edit', ['resource' => trans('user::users.profile')])) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('admin.profile.update') }}" class="form-horizontal" id="profile-form" novalidate>
            {{ csrf_field() }}
            {{ method_field('put') }}

            {!! $tabs->render() !!}
        </form>
    </div>
</div>
@endsection
