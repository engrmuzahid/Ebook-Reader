@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('user::users.users')))

    <li class="nav-item">{{ clean(trans('user::users.users')) }}</li>
@endcomponent

@component('admin::include.page.table')
    @slot('title', clean(trans('user::users.users')))
    @slot('buttons', ['create'])
    @slot('resource', 'users')
    @slot('name', clean(trans('user::users.user')))

    @slot('thead')
        <tr>
            @include('admin::include.table.select-all',["name"=>trans('user::users.user')])
            <th>{{ clean(trans('user::users.table.avatar')) }}</th>
            <th>{{ clean(trans('user::users.table.first_name')) }}</th>
            <th>{{ clean(trans('user::users.table.last_name')) }}</th>
            <th>{{ clean(trans('user::users.table.username')) }}</th>
            <th>{{ clean(trans('user::users.table.email')) }}</th>
            <th>{{ clean(trans('user::users.table.last_login')) }}</th>
            <th>{{ clean(trans('admin::admin.table.status')) }}</th>
            <th data-sort>{{ clean(trans('admin::admin.table.created')) }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
    (function () {
        "use strict";
        new DataTable('#users-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'avatar', orderable: false, searchable: false, width: '10%' },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'username', name: 'username' },
                { data: 'email', name: 'email' },
                { data: 'last_login', name: 'last_login', searchable: false },
                { data: 'status', name: 'status',orderable: false, searchable: false },
                { data: 'created', name: 'created_at' },
            ]
        });
    })();
    </script>
@endpush
