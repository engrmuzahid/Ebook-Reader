@extends('public.account.layout')

@section('title', clean(trans('cynoebook::account.links.my_reviews')))

@section('account_breadcrumb')
    <li class="active">{{ clean(trans('cynoebook::account.links.my_reviews')) }}</li>
@endsection

@section('content_right')
    <div class="index-table">
        @if ($reviews->isEmpty())
            <h3 class="text-center">{{ clean(trans('cynoebook::account.reviews.no_reviews')) }}</h3>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ clean(trans('cynoebook::account.reviews.book_cover')) }}</th>
                            <th>{{ clean(trans('cynoebook::account.reviews.ebook')) }}</th>
                            <th>{{ clean(trans('cynoebook::account.reviews.rating')) }}</th>
                            <th>{{ clean(trans('cynoebook::account.reviews.date')) }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <td>
                                    @if (! $review->ebook->book_cover->exists)
                                        <div class="image-placeholder">
                                            <i class="fa fa-picture-o" aria-hidden="true"></i>
                                        </div>
                                    @else
                                        <div class="image-holder">
                                            <img src="{{ $review->ebook->book_cover->path }}">
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('ebooks.show', ['slug' => $review->ebook->slug]) }}">{{ $review->ebook->title }}</a>
                                </td>

                                <td>
                                    @include('public.ebooks.partials.ebook.rating', ['rating' => $review->rating])
                                </td>

                                <td>{{ $review->created_at->toFormattedDateString() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @if ($reviews->isNotEmpty())
        <div class="pull-right">
            {!! $reviews->links() !!}
        </div>
    @endif
@endsection
