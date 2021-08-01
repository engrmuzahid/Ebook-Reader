@extends('public.account.layout')

@section('title', clean(trans('cynoebook::account.links.my_authors')))

@section('account_breadcrumb')
    <li><a href="{{ route('account.authors.index') }}">{{ clean(trans('cynoebook::account.links.my_authors')) }}</a></li>
    <li class="active">{{ clean(trans('cynoebook::account.authors.edit_author')) }}</li>
@endsection


@section('content_right')
    <div class="my-dashboard">
        <div class="account-information clearfix">
            <h4>{{ clean(trans('cynoebook::account.authors.edit_author')) }} - {{ $author->name }}
            
            </h4>

            <div class="col-md-12">
                <div class="row">
                    <div class="index-table">
                        <form method="POST" action="{{ route('account.authors.update', $author) }}" class="form-horizontal" id="author-create-form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        {{ Form::text('name', clean(trans('author::attributes.name')), $errors, $author, ['required' => true]) }}
                        @if (request()->routeIs('account.authors.edit'))
                            {{ Form::text('slug', clean(trans('author::attributes.slug')), $errors,$author,['required' => true]) }}
                        @endif
                        {{ Form::wysiwyg('description', clean(trans('author::attributes.description')), $errors, $author, []) }}
                        {{ Form::file('author_image',clean(trans('author::attributes.image')), $errors,'' ) }}
                        <div class="pull-right">
                            @if (! $author->author_image->exists)
                                <div class="">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                </div>
                            @else
                                <div class="">
                                    <img src="{{ $author->author_image->path }}" width="50px">
                                </div>
                            @endif                
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="form-group row ">
                            <label for="is_active" class="col-md-4 text-left">{{clean(trans('author::attributes.is_active'))}} </label>
                            <div class="col-md-8 p-0">
                                <div class="custom-control custom-checkbox">
                                    <label class="custom-control-label" for="is_active">
                                    {{ $author->is_active==1 ? 'Yes': 'No' }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="is_verified" class="col-md-4 text-left">{{clean(trans('author::attributes.is_verified'))}} </label>
                            <div class="col-md-8 p-0">
                                <div class="custom-control custom-checkbox">
                                    <label class="custom-control-label" for="is_verified">
                                    {{ $author->is_verified==1 ? 'Yes': 'No' }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        
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
