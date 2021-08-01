<div class="col-lg-4 col-md-5">
    <div class="rating">
        <div class="average-rating clearfix">
            <div class="average pull-left">
                <span>{{ intl_number($ebook->avgRating()) }}</span>
            </div>
            <div class="pull-left">
                @include('public.ebooks.partials.ebook.rating', ['rating' => $ebook->avgRating()])

                <span class="rate-of-average">
                    {{ intl_number($ebook->avgRating()) }} {{ clean(trans('cynoebook::ebook.reviews.out_of_5')) }}
                    ({{ intl_number($ebook->reviews->count()) }} {{ clean(trans('cynoebook::ebook.user_reviews')) }} )
                </span>

            </div>
        </div>

    </div>
    <div class="review-form clearfix">
                <form method="POST" action="{{ route('ebooks.reviews.store', $ebook) }}" class="clearfix">
                    {{ csrf_field() }}

                    <h3>{{ clean(trans('cynoebook::ebook.reviews.add_a_review')) }}</h3>

                    <span>
                        {{ clean(trans('cynoebook::ebook.reviews.your_rating')) }}
                        <span class="rating-required">*</span>
                    </span>

                    <div class="clearfix"></div>

                    <fieldset class="rating">
                        <input type="radio" id="star-5" name="rating" value="5">
                        <label class="full" for="star-5" data-toggle="tooltip" title="{{ clean(trans('cynoebook::ebook.reviews.5_star')) }}"></label>

                        <input type="radio" id="star-4" name="rating" value="4">
                        <label class="full" for="star-4" data-toggle="tooltip" title="{{ clean(trans('cynoebook::ebook.reviews.4_star')) }}"></label>

                        <input type="radio" id="star-3" name="rating" value="3">
                        <label class="full" for="star-3" data-toggle="tooltip" title="{{ clean(trans('cynoebook::ebook.reviews.3_star')) }}"></label>

                        <input type="radio" id="star-2" name="rating" value="2">
                        <label class="full" for="star-2" data-toggle="tooltip" title="{{ clean(trans('cynoebook::ebook.reviews.2_star')) }}"></label>

                        <input type="radio" id="star-1" name="rating" value="1">
                        <label class="full" for="star-1" data-toggle="tooltip" title="{{ clean(trans('cynoebook::ebook.reviews.1_star')) }}"></label>
                    </fieldset>

                    @if($errors->has('rating'))
                        <span class="error-message">{{ clean($errors->first('rating')) }}</span>
                    @endif

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('reviewer_name') ? 'has-error' : '' }}">
                                <label for="reviewer-name">
                                    {{ clean(trans('cynoebook::ebook.reviews.reviewer_name')) }}<span>*</span>
                                </label>

                                <input type="text" name="reviewer_name" class="form-control" id="reviewer-name" value="{{ old('reviewer_name', auth()->user()->full_name ?? '') }}">

                                @if($errors->has('reviewer_name'))
                                    <span class="error-message">{{ clean($errors->first('reviewer_name')) }}</span>
                                @endif

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                                <label for="comment">
                                    {{ clean(trans('cynoebook::ebook.reviews.your_review')) }}<span>*</span>
                                </label>

                                <textarea name="comment" class="form-control" id="comment" cols="30" rows="5">{{ old('comment') }}</textarea>

                                @if ($errors->has('comment'))
                                    <span class="error-message">{{ clean($errors->first('comment')) }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('captcha') ? 'has-error': '' }}">
                                @captcha
                                <input type="text" name="captcha" id="captcha" class="captcha-input">

                                @if($errors->has('captcha'))
                                    <span class="error-message">{{ clean($errors->first('captcha')) }}</span>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary review-submit" data-loading>
                            {{ clean(trans('cynoebook::ebook.reviews.add_review')) }}
                        </button>
                    </div>
                </form>
            </div>
        
</div>
