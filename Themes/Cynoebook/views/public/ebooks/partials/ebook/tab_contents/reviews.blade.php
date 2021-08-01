<div id="reviews" class="reviews tab-pane fade in clearfix {{ request()->has('reviews') || review_form_has_error($errors) ? 'active' : '' }}">
    <div class="row">
        <div class="col-lg-8 col-md-7">
            <div class="user-review clearfix">
                @forelse ($reviews as $review)
                    <div class="comment">
                        <div class="comment-details">
                            <div class="col-lg-3">
                                <h5 class="user-name">{{ $review->reviewer_name }}</h5>
                                @include('public.ebooks.partials.ebook.rating', ['rating' => $review->rating])
                                <span class="time" data-toggle="tooltip" title="{{ $review->created_at->toFormattedDateString() }}">
                                {{ $review->created_at->diffForHumans() }}
                            </span>
                            </div>
                            <div class="col-lg-9">
                                <p class="user-text1">{{ $review->comment }}</p>
                            </div>
                            <div class="clearfix"></div>
                            
                        </div>
                    </div>
                @empty
                    <h3>{{ clean(trans('cynoebook::ebook.reviews.there_are_no_reviews_for_this_ebook')) }}</h3>
                @endforelse

                <div class="pull-right">
                    {!! $reviews->links() !!}
                </div>
            </div>

        </div>
        @include('public.ebooks.partials.ebook.reviews.ratings_overview')
    </div>
</div>
