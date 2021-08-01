@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('files::files.files')))

    <li class="nav-item">{{ clean(trans('files::files.files')) }}</li>
@endcomponent
@section('content')
    @include('files::admin.files.include.uploader')
    @include('files::admin.files.include.table')
@endsection

@push('scripts')
<script>
    
    (function () {
        "use strict";
        DataTable.setRoutes('#files-table .table', {
            index: '{{ "admin.files.index" }}',
            
            @hasAccess("admin.files.edit")
                
                edit: '{{ "admin.files.edit" }}',
                
            @endHasAccess
            @hasAccess("admin.files.destroy") 
                destroy: '{{ "admin.files.destroy" }}',
            @endHasAccess
        });
        new DataTable('#files-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'thumbnail', orderable: false, searchable: false, width: '10%' },
                { data: 'filename', name: 'filename' },
                { data: 'size', name: 'size', orderable: false,searchable: false,},
                { data: 'extension', name: 'extension' },
                { data: 'created', name: 'created_at' },
                { data: 'action', name: 'action',orderable: false, searchable: false,className:"noclickable" },
            ],
        });
        
    })();   
    
</script>
@endpush
