@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('cynoebook::cynoebook.cynoebook')))
    
    <li class="nav-item"> {{ clean(trans('cynoebook::cynoebook.cynoebook')) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('admin.cynoebook.settings.update') }}" class="form-horizontal" id="cynoebook-settings-edit-form" novalidate>
            {{ csrf_field() }}
            {{ method_field('put') }}

            {!! $tabs->render(compact('settings')) !!}
        </form>
    </div>
</div>
@endsection
