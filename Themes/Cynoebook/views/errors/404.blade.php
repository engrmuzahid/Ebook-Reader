@extends('public.layout')

@section('title', clean(trans('cynoebook::404.not_found')))

@section('content')
    <div class="row">
        <div class="page-error clearfix">
            <span>40<span>4</span></span>

            <div class="col-md-4 col-md-offset-4">
                <div class="error-text text-center">
                    <h1>{{ clean(trans('cynoebook::404.oops')) }}</h1>
                    <h4>{{ clean(trans('cynoebook::404.the_page_not_found')) }}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
