@extends('admin::layout')

@section('title', clean(trans('admin::dashboard.dashboard')))

@section('page-header')
    <h4 class="page-title">{{ clean(trans('admin::dashboard.dashboard')) }}</h4>
@endsection


@section('content')
    @hasAccess('admin.ebooks.index')
        @include('admin::dashboard.include.ebooks')
    @endHasAccess
    @hasAccess('admin.users.index')
        @include('admin::dashboard.include.users')
    @endHasAccess
    @hasAccess('admin.ebooks.index')
        @include('admin::dashboard.include.latest-ebooks')
    @endHasAccess
    
    <div class="row">
        <div class="col-sm-5">
            @hasAccess('admin.reviews.index')
                @include('admin::dashboard.include.latest_reviews')
            @endHasAccess
        </div>
        <div class="col-sm-7">
            @hasAccess('admin.reportedebooks.index')
                @include('admin::dashboard.include.latest_reportedebooks')
            @endHasAccess
        </div>
    </div>
@endsection