<div class="row">
<div class="col-sm-12">
    <h4 class="page-title border-bottom"><i class="fa fa-star" aria-hidden="true"></i> {{ clean(trans('admin::dashboard.latest_reviews')) }}</h4>
    <div class="card">
            
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive table-hover ">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ clean(trans('admin::dashboard.table.latest_reviews.ebook')) }}</th>
                                    <th>{{ clean(trans('admin::dashboard.table.user')) }}</th>
                                    <th>{{ clean(trans('admin::dashboard.table.latest_reviews.rating')) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $inc=0; @endphp
                                @foreach($latestReviews as $latestReview)
                                @php $inc++; @endphp
                                    <tr>
                                        <td>
                                        {{ $inc }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.reviews.edit', $latestReview) }}">
                                                {{ $latestReview->ebook->title }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.reviews.edit', $latestReview) }}">
                                                {{ $latestReview->reviewer_name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.reviews.edit', $latestReview) }}">
                                                {{ $latestReview->rating }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>