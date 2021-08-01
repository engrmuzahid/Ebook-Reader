@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('review::reviews.reviews')))

    <li class="nav-item">{{ clean(trans('review::reviews.reviews')) }}</li>
@endcomponent

@component('admin::include.page.table')
    @slot('title', clean(trans('review::reviews.review')))
    @slot('resource', 'reviews')
    @slot('name', clean(trans('review::reviews.review')))

    @slot('thead')
        <tr>
            @include('admin::include.table.select-all',["name"=>trans('review::reviews.review')])
            <th>{{ clean(trans('review::reviews.table.ebook')) }}</th>
            <th>{{ clean(trans('review::reviews.table.reviewer_name')) }}</th>
            <th>{{ clean(trans('review::reviews.table.rating')) }}</th>
            <th>{{ clean(trans('review::reviews.table.approved')) }}</th>
            <th data-sort>{{ clean(trans('admin::admin.table.created')) }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
        new DataTable('#reviews-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'ebook', name: 'ebook.slug', orderable: false, searchable: false, defaultContent: '' },
                { data: 'reviewer_name' },
                { data: 'rating' },
                { data: 'status', name: 'is_approved', searchable: false },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
