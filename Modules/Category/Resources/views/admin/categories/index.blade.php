@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('category::categories.categories')))

    <li class="nav-item">{{ clean(trans('category::categories.categories')) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <a href="#" class="collapse-all">{{ clean(trans('category::categories.tree.collapse_all')) }}</a> |
                <a href="#" class="expand-all">{{ clean(trans('category::categories.tree.expand_all')) }}</a>
                
            </div>
            <div class="card-body" id="menus-table">
                
                <div class="category-tree"></div>
            </div>
        </div>
    
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header clearfix">
                <div class="pull-right">
                    <button class="btn btn-primary  ml-auto add-root-category">{{ clean(trans('category::categories.tree.add_root_category')) }}</button>
                    <button class="btn btn-primary ml-auto add-sub-category disabled">{{ clean(trans('category::categories.tree.add_sub_category')) }}</button>
                
                </div>
            </div>
            <form method="POST" action="{{ route('admin.categories.store') }}" class="form-horizontal" id="category-form" novalidate>
            {{ csrf_field() }}
                <div class="card-body">
                    {{ Form::text('name', clean(trans('category::attributes.name')), $errors, null, ['required' => true]) }}
                    <div id="slug-field" class="d-none">
                    {{ Form::text('slug', clean(trans('category::attributes.slug')), $errors) }}
                    </div>
                    {{ Form::checkbox('is_searchable', clean(trans('category::attributes.is_searchable')), clean(trans('category::categories.form.show_this_category_in_search_box')), $errors) }}
                    {{ Form::checkbox('is_active', clean(trans('category::attributes.is_active')), clean(trans('category::categories.form.enable_the_category')), $errors) }}
                    
                </div>
                <div class="card-footer">
                    <div class="form-group clearfix">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary" data-loading>
                                {{ clean(trans('admin::admin.buttons.save')) }}
                            </button>

                            <button type="button" class="btn btn-danger btn-delete-category d-none" data-loading>
                                {{ clean(trans('admin::admin.buttons.delete')) }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <form method="POST" id="categories-delete-form" action="">
                {{ csrf_field() }}
                {{ method_field('delete') }}
            
            </form>
        </div>
    </div>
</div>
@endsection
