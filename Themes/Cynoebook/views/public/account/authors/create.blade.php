@extends('public.account.layout')

@section('title', clean(trans('cynoebook::account.links.my_authors')))

@section('account_breadcrumb')
    <li><a href="{{ route('account.authors.index') }}">{{ clean(trans('cynoebook::account.links.my_authors')) }}</a></li>
    <li class="active">{{ clean(trans('cynoebook::account.authors.new_author')) }}</li>
@endsection


@section('content_right')
    <div class="my-dashboard">
        <div class="account-information clearfix">
            <h4>{{ clean(trans('cynoebook::account.authors.new_author')) }}
            
            </h4>

            <div class="col-md-12">
                <div class="row">
                    <div class="index-table">
                        <form method="POST" action="{{ route('account.authors.store') }}" class="form-horizontal" id="author-create-form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ Form::text('name', clean(trans('author::attributes.name')), $errors, '', ['required' => true]) }}
                        @if (request()->routeIs('account.authors.edit'))
                            {{ Form::text('slug', clean(trans('author::attributes.slug')), $errors,'',['required' => true]) }}
                        @endif
                        {{ Form::wysiwyg('description', clean(trans('author::attributes.description')), $errors,'', []) }}
                        {{ Form::file('author_image',clean(trans('author::attributes.image')), $errors,'' ) }}
                        
                            <div class="form-group pull-right">
                                <button type="submit" class="btn btn-primary" data-loading>
                                {{ clean(trans('cynoebook::account.authors.save_author')) }}
                                </button>
                            </div>
                        <div class="clearfix"></div>
                        </form>       
                            
                            
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
   
@endsection
