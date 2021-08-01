@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('menu::menus.menus')))

    <li class="nav-item">{{ clean(trans('menu::menus.menus')) }}</li>
@endcomponent

@component('admin::include.page.table')
    @slot('title', clean(trans('menu::menus.menu')))
    @slot('buttons', ['create'])
    @slot('resource', 'menus')
    @slot('name', clean(trans('menu::menus.menu')))

    @slot('thead')
        <tr>
            @include('admin::include.table.select-all',["name"=>clean(trans('menu::menus.menu'))])
            <th>{{ clean(trans('menu::menus.table.name')) }}</th>
            <th>{{ clean(trans('admin::admin.table.status')) }}</th>
            <th data-sort>{{ clean(trans('admin::admin.table.created')) }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
    (function () {
        "use strict";
        

        new DataTable('#menus-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'name', name: 'translations.name', orderable: false, defaultContent: '' },
                { data: 'status', name: 'is_active', searchable: false },
                { data: 'created', name: 'created_at' },
            ]
        });
    })();
    </script>
@endpush
