@php
    if (isset($approved) and $approved == true) {
        $comments = $model->approvedComments;
    } else {
        $comments = $model->comments;
    }
@endphp
<div class="col-lg-12">
@if($comments->count() < 1)
    <div class="alert alert-warning">{{ clean(trans('cynoebook::comments.there_are_no_comments_for_this_ebook')) }}</div>
@endif

<ul class="list-unstyled">
    @php
        $comments = $comments->sortBy('created_at');

        if (isset($perPage)) {
            $page = request()->query('page', 1) - 1;

            $parentComments = $comments->where('child_id', '');

            $slicedParentComments = $parentComments->slice($page * $perPage, $perPage);

            $m = Config::get('comments.model'); // This has to be done like this, otherwise it will complain.
            $modelKeyName = (new $m)->getKeyName(); // This defaults to 'id' if not changed.

            $slicedParentCommentsIds = $slicedParentComments->pluck($modelKeyName)->toArray();

            // Remove parent Comments from comments.
            $comments = $comments->where('child_id', '!=', '');

            $grouped_comments = new \Illuminate\Pagination\LengthAwarePaginator(
                $slicedParentComments->merge($comments)->groupBy('child_id'),
                $parentComments->count(),
                $perPage
            );

            $grouped_comments->appends(['comment'=>'true'])->withPath(request()->url());
        } else {
            $grouped_comments = $comments->groupBy('child_id');
        }
    @endphp
    @foreach($grouped_comments as $comment_id => $comments)
        {{-- Process parent nodes --}}
        @if($comment_id == '')
            @foreach($comments as $comment)
                @include('comments::_comment', [
                    'comment' => $comment,
                    'grouped_comments' => $grouped_comments
                ])
            @endforeach
        @endif
    @endforeach
</ul>

@isset ($perPage)
    {{ $grouped_comments->links() }}
@endisset
</div>
<div class="col-lg-12">
@auth
    @include('comments::_form')
@elseif(Config::get('comments.guest_commenting') == true)
    @include('comments::_form', [
        'guest_commenting' => true
    ])
@else
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="message">{{ clean(trans('cynoebook::comments.leave_your_comment')) }}<span>*</span></label>
                <textarea required class="form-control   @if($errors->has('message')) error @endif" name="message" rows="3"></textarea>
            </div>
            <div class="alert alert-warning">{{ clean(trans('cynoebook::comments.you_must_log_in_to_post_a_comment')) }}</div>
            
            <a href="{{ route('login') }}" class="btn btn-primary pull-right">{{ clean(trans('cynoebook::comments.log_in')) }}</a>
        </div>
    </div>
@endauth
</div>
