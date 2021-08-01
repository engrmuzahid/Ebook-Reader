{{ Form::select('rating', clean(trans('review::attributes.rating')), $errors, array_combine(range(1, 5), range(1, 5)), $review, ['required' => true]) }}
{{ Form::text('reviewer_name', clean(trans('review::attributes.reviewer_name')), $errors, $review, ['required' => true]) }}
{{ Form::textarea('comment', clean(trans('review::attributes.comment')), $errors, $review, ['required' => true]) }}
{{ Form::checkbox('is_approved', clean(trans('review::attributes.is_approved')), clean(trans('review::reviews.form.approve_this_review')), $errors, $review) }}
    
