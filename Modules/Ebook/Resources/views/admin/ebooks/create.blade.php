@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('admin::resource.create', ['resource' => trans('ebook::ebooks.ebook')])))
    
    <li class="nav-item"><a href="{{ route('admin.ebooks.index') }}">{{ clean(trans('ebook::ebooks.ebooks')) }}</a></li>
    <li class="separator"><i class="flaticon-right-arrow"></i></li>
    <li class="nav-item">{{ clean(trans('admin::resource.create', ['resource' => trans('ebook::ebooks.ebook')])) }}</li>
@endcomponent

@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('admin.ebooks.store') }}" class="form-horizontal" id="ebook-create-form" novalidate>
            {{ csrf_field() }}
             
           {!! $tabs->render(compact('ebook')) !!}
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $('.csselect2').select2({
            createTag: function(newTag) {
               return {
                   id: 'new:' + newTag.term,
                   text: newTag.term + ' (new)'
               };
           }
            
        });
    </script>
@endpush