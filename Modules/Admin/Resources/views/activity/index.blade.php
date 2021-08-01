@extends('admin::layout')


@component('admin::include.page.header')
    @slot('title', clean(trans('admin::activity.activitylogs')))
    <li class="nav-item">
        <a href="#">
            {{ clean(trans('admin::activity.activitylogs')) }}
        </a>
    </li>
@endcomponent

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ clean(trans('admin::activity.activitylogs')) }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="activity-table">
                        <table class="display table table-striped table-hover translations-table">
                            <thead>
                                <tr>
                                    <th data-sort>{{ clean(trans('admin::activity.table.id')) }}</th>
                                    <th>{{ clean(trans('admin::activity.table.user')) }}</th>
                                    <th>{{ clean(trans('admin::activity.table.activity')) }}</th>
                                    <th >{{ clean(trans('admin::activity.table.log_time')) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        DataTable.setRoutes('#activity-table .table', {
                index: '{{ "admin.activity.index" }}',
        });
        
        new DataTable('#activity-table .table', {
            columns: [
                { data: 'id', name: 'id' },
                { data: 'user', name: 'user' ,orderable: false},
                { data: 'description', name: 'description' ,orderable: false},
                { data: 'created_at', name: 'created_at' },
            ]
        });
    </script>
@endpush