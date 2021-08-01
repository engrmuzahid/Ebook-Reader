@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('user::roles.roles')))

    <li class="nav-item">{{ clean(trans('user::roles.roles')) }}</li>
@endcomponent

@component('admin::include.page.table')
    @slot('title', clean(trans('user::roles.roles')))
    @slot('buttons', ['create'])
    @slot('resource', 'roles')
    @slot('name', clean(trans('user::roles.role')))

    @slot('thead')
        <tr>
             @include('admin::include.table.select-all',["name"=>trans('user::users.user')])

            <th>{{ clean(trans('user::roles.table.name')) }}</th>
            <th>{{ clean(trans('user::roles.table.slug')) }}</th>
            <th data-sort>{{ clean(trans('admin::admin.table.created')) }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
    (function () {
        "use strict";
        new DataTable('#roles-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'name', name: 'name' },
                { data: 'slug', name: 'slug' },
                { data: 'created', name: 'created_at' },
            ]
        });
    })();
    </script>
@endpush
