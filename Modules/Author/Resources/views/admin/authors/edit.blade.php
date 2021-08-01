@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('admin::resource.edit', ['resource' => trans('author::authors.author')])))
    @slot('subtitle', $author->name)
    <li class="nav-item"><a href="{{ route('admin.authors.index') }}">{{ clean(trans('author::authors.authors')) }}</a></li>
    <li class="separator"><i class="flaticon-right-arrow"></i></li>
    <li class="nav-item">{{ clean(trans('admin::resource.edit', ['resource' => trans('author::authors.author')])) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('admin.authors.update', $author) }}" class="form-horizontal" id="author-edit-form" novalidate>
            {{ csrf_field() }}
            {{ method_field('put') }}

            {!! $tabs->render(compact('author')) !!}
        </form>
    </div>
</div>
@endsection
