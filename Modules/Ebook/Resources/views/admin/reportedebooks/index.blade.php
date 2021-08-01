@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('ebook::reportedebooks.ebooks')))

    <li class="nav-item">{{ clean(trans('ebook::reportedebooks.ebooks')) }}</li>
@endcomponent
@component('admin::include.page.table')
    @slot('title', clean(trans('ebook::ebooks.ebooks')))
    @slot('buttons', ['create'])
    @slot('resource', 'reportedebooks')
    @slot('name', clean(trans('ebook::ebooks.ebooks')))
    @slot('noedit', 1)
    
    @slot('thead')
        <tr>
            @include('admin::include.table.select-all',["name"=>trans('ebook::reportedebooks.ebooks')])
            <th>{{ trans('ebook::reportedebooks.table.title') }}</th>
            <th>{{ trans('ebook::reportedebooks.table.user') }}</th>
            <th>{{ trans('ebook::reportedebooks.table.reason') }}</th>
            <th data-sort>{{ trans('admin::admin.table.created') }}</th>
            <th>{{ trans('admin::admin.table.action') }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
            
        new DataTable('#reportedebooks-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'ebook.title', name: 'ebook.slug', orderable: false, defaultContent: '' },
                { data: 'user.full_name', name: 'user.first_name', orderable: false, defaultContent: '' },
                { data: 'reason', name: 'reason', orderable: false, defaultContent: '' },
                { data: 'created', name: 'created_at' },
                { data: 'action', name: 'action',orderable: false, searchable: false,className:"noclickable" },
            ],
            
        });
    </script>
@endpush
