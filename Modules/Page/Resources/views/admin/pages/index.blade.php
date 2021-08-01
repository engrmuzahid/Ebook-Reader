@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('page::pages.pages')))

    <li class="nav-item">{{ clean(trans('page::pages.pages')) }}</li>
@endcomponent

@component('admin::include.page.table')
    @slot('title', clean(trans('page::pages.page')))
    @slot('buttons', ['create'])
    @slot('resource', 'pages')
    @slot('name', clean(trans('page::pages.page')))

    @slot('thead')
        <tr>
            @include('admin::include.table.select-all',["name"=>clean(trans('page::pages.page'))])
            
            <th>{{ clean(trans('page::pages.table.name')) }}</th>
            <th>{{ clean(trans('admin::admin.table.status')) }}</th>
            <th data-sort>{{ clean(trans('admin::admin.table.created')) }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
    (function () {
        "use strict";
        new DataTable('#pages-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'name', name: 'translations.name', orderable: false, defaultContent: '' },
                { data: 'status', name: 'is_active', searchable: false },
                { data: 'created', name: 'created_at' },
            ],
        });
    })();
    </script>
@endpush
