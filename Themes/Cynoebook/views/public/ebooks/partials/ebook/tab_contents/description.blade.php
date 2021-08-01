<div id="description" class="description tab-pane fade in {{ request()->has('comment') || request()->has('reviews') || review_form_has_error($errors) || comment_form_has_error($errors) ? '' : 'active' }}">
    {!! $ebook->description !!}
</div>
