@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('ebook::ebooks.ebooks')))

    <li class="nav-item">{{ clean(trans('ebook::ebooks.ebooks')) }}</li>
@endcomponent

@component('admin::include.page.table')
    @slot('title', clean(trans('ebook::ebooks.ebooks')))
    @slot('buttons', ['create'])
    @slot('resource', 'ebooks')
    @slot('name', clean(trans('ebook::ebooks.ebooks')))

    @slot('thead')
        <tr>
            @include('admin::include.table.select-all',["name"=>trans('ebook::ebooks.ebook')])
            <th>{{ clean(trans('ebook::ebooks.table.bookcover')) }}</th>
            <th>{{ clean(trans('ebook::ebooks.table.title')) }}</th>
            <th>{{ clean(trans('ebook::ebooks.table.user')) }}</th>
            <th>{{ clean(trans('ebook::ebooks.table.password')) }}</th>
            <th>{{ clean(trans('ebook::ebooks.table.is_featured')) }}</th>
            <th>{{ clean(trans('ebook::ebooks.table.is_private')) }}</th>
            <th>{{ clean(trans('ebook::ebooks.table.views')) }}</th>
            <th>{{ clean(trans('admin::admin.table.status')) }}</th>
            <th data-sort>{{ clean(trans('admin::admin.table.created')) }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
        new DataTable('#ebooks-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'bookcover', orderable: false, searchable: false, width: '10%' },
                { data: 'title', name: 'translations.title', orderable: false, defaultContent: '' },
                { data: 'user.full_name', name: 'user.first_name', orderable: false, defaultContent: '' },
                { data: 'password', name: 'password', orderable: false, defaultContent: '' },
                { data: 'is_featured', name: 'is_featured', orderable: false, defaultContent: '' },
                { data: 'is_private', name: 'is_private', orderable: false, defaultContent: '' },
                { data: 'viewed', name: 'viewed', orderable: false, defaultContent: '' },
                { data: 'status', name: 'is_active', searchable: false },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
