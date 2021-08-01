@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('slider::sliders.sliders')))

    <li class="nav-item">{{ clean(trans('slider::sliders.sliders')) }}</li>
@endcomponent

@component('admin::include.page.table')
    @slot('title', clean(trans('slider::sliders.slider')))
    @slot('buttons', ['create'])
    @slot('resource', 'sliders')
    @slot('name', clean(trans('slider::sliders.slider')))

    @slot('thead')
        <tr>
            @include('admin::include.table.select-all',["name"=>trans('slider::sliders.slider')])
            <th>{{ clean(trans('slider::sliders.table.name')) }}</th>
            <th data-sort>{{ clean(trans('admin::admin.table.created')) }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
    (function () {
        "use strict";
        new DataTable('#sliders-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'name', name: 'translations.name', orderable: false, defaultContent: '' },
                { data: 'created', name: 'created_at' },
            ],
        });
    })();
    </script>
@endpush
