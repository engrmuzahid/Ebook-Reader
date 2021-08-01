<div class="card">
    <div class="card-body">
        @if($errors->has('commentable_type'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('commentable_type') }}
            </div>
        @endif
        @if($errors->has('commentable_id'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('commentable_id') }}
            </div>
        @endif
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            @honeypot
            <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
            <input type="hidden" name="commentable_id" value="{{ $model->getKey() }}" />

            {{-- Guest commenting --}}
            @if(isset($guest_commenting) and $guest_commenting == true)
                <div class="form-group">
                    <label for="message">Enter your name here:</label>
                    <input type="text" class="form-control @if($errors->has('guest_name')) error @endif" name="guest_name" />
                    @error('guest_name')
                       <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="message">Enter your email here:</label>
                    <input type="email" class="form-control @if($errors->has('guest_email')) error @endif" name="guest_email" />
                    @error('guest_email')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            @endif

            <div class="form-group">
                <label for="message">{{ clean(trans('cynoebook::comments.leave_your_comment')) }}<span>*</span></label>
                <textarea  class="form-control   @if($errors->has('message')) error @endif" name="message" rows="3"></textarea>
                @if($errors->has('message'))
                <span class="error-message">{{ clean(trans('cynoebook::comments.please_enter_comment_text'))}}</span>
                @endif
                
            </div>
            <button type="submit" class="btn btn-primary comments-submit pull-right" data-loading>
                {{ clean(trans('cynoebook::comments.post_comment')) }}
            </button>
            
        </form>
    </div>
</div>
<br />