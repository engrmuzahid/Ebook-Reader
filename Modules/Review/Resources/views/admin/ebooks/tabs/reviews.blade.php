<div class="table-responsive">
    
    <table class="display table table-striped table-hover" id="ebook-reviews-table">
        <thead>
            @include('admin::include.table.select-all',["name"=>trans('review::reviews.review')])
            <th>{{ clean(trans('review::reviews.table.reviewer_name')) }}</th>
            <th>{{ clean(trans('review::reviews.table.rating')) }}</th>
            <th>{{ clean(trans('review::reviews.table.approved')) }}</th>
            <th data-sort>{{ clean(trans('admin::admin.table.created')) }}</th>
        
        </thead>

        <tbody></tbody>

        
    </table>
    
</div>


@push('scripts')
    <script>
        DataTable.setRoutes('#ebook-reviews-table', {
            index: { name: 'admin.ebooks.reviews.index',params:{'ebookId':{{$ebook->id}}} },
            edit: { name: 'admin.reviews.edit' },
            destroy: { name: 'admin.reviews.destroy' },
        });

        new DataTable('#ebook-reviews-table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'reviewer_name' },
                { data: 'rating' },
                { data: 'status', name: 'is_approved', searchable: false },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
