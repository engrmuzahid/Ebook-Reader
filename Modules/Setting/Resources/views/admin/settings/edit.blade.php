@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('setting::settings.settings')))
    
    <li class="nav-item"> {{ clean(trans('setting::settings.settings')) }}</li>
@endcomponent

@section('content')
<div class="row clearfix mb-2">
    <div class="col-md-12 clearfix text-right">
        <a href="{{ route('admin.settings.cacheClear') }}" class="btn btn-sm btn-danger">
            <i class="fa fa-trash"> </i> {{ clean(trans('setting::attributes.clear_cache')) }}
        </a>
        <a href="{{ route('admin.settings.updateSitemap') }}" class="btn btn-sm btn-primary"> 
            <i class="fas fa-sitemap"></i> {{ clean(trans('setting::attributes.update_sitemap')) }}
        </a>
        <a href="{{ url('sitemap.xml') }}" class="btn btn-sm btn-primary" target="_blank"> 
            <i class="fa fa-link"></i> {{ clean(trans('setting::attributes.go_to_sitemap')) }}
        </a>
        
        
    </div>
</div>
<div class="row">
    
    <div class="col-md-12">
        <form method="POST" action="{{ route('admin.settings.update') }}" class="form-horizontal" id="settings-edit-form" novalidate>
            {{ csrf_field() }}
            {{ method_field('put') }}

            {!! $tabs->render(compact('settings')) !!}
        </form>
    </div>
</div>
@endsection
