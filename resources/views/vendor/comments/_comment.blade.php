@inject('markdown', 'Parsedown')
@php($markdown->setSafeMode(true))

@if(isset($reply) && $reply === true)
  <div id="comment-{{ $comment->getKey() }}" class="media" style="display: flex;">
@else
  <li id="comment-{{ $comment->getKey() }}" class="media" style="display: flex;">
@endif


@if(isset($comment->commenter->email) && isset($comment->commenter->avatar->path))
    <img src="{{ $comment->commenter->avatar->path }}" alt="..." class="avatar-img rounded-circle" style="width: 65px;height: 65px;border-radius: 5px;">
@else
    <img src="{{ url('modules/admin/images/user-icon.png') }}" alt="..." class="avatar-img rounded" style="width: 65px;height: 65px;border-radius: 5px;">
@endif
        
    <div class="media-body p-l-15">
            <h5 class="m-b-10">{{ $comment->commenter->full_name ?? $comment->guest_name }} <small class="text-muted">- {{ $comment->created_at->diffForHumans() }}</small></h5>
            <div  class="m-b-10"style="white-space: pre-wrap;">{!! $markdown->line($comment->comment) !!}</div>
            <div>
                @can('reply-to-comment', $comment)
                    <a href="#" data-toggle="modal" data-target="#reply-modal-{{ $comment->getKey() }}" class="text-uppercase1 p-l-15">{{ clean(trans('cynoebook::comments.reply'))}}</a>
                @endcan
                @can('edit-comment', $comment)
                    <a href="#" data-toggle="modal" data-target="#comment-modal-{{ $comment->getKey() }}" class="p-l-15">{{ clean(trans('cynoebook::comments.edit'))}}</a>
                @endcan
                @can('delete-comment', $comment)
                    <a href="{{ route('comments.destroy', $comment->getKey()) }}" onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();" class="text-danger p-l-15">{{ clean(trans('cynoebook::comments.delete'))}}</a>
                    <form id="comment-delete-form-{{ $comment->getKey() }}" action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
                @endcan
            </div>
            
            

            @can('edit-comment', $comment)
                <div class="modal fade" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
                                @method('PUT')
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ clean(trans('cynoebook::comments.edit_comment'))}}
                                    <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                    </button>
                                    
                                    </h5>
                                    
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="message">{{ clean(trans('cynoebook::comments.update_your_comment'))}}:</label>
                                        <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>
                                        
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">{{ clean(trans('cynoebook::comments.cancel'))}}</button>
                                    <button type="submit" class="btn btn-sm btn-primary">{{ clean(trans('cynoebook::comments.update'))}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            @can('reply-to-comment', $comment)
                <div class="modal fade " id="reply-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ clean(trans('cynoebook::comments.reply_to_comment'))}}
                                    <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                    </button>
                                    </h5>
                                    
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="message">{{ clean(trans('cynoebook::comments.leave_your_comment'))}}:</label>
                                        <textarea required class="form-control" name="message" rows="3"></textarea>
                                        
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">{{ clean(trans('cynoebook::comments.cancel'))}}</button>
                                    <button type="submit" class="btn btn-sm btn-primary">{{ clean(trans('cynoebook::comments.reply'))}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            {{-- Margin bottom --}}

            {{-- Recursion for children --}}
            @if($grouped_comments->has($comment->getKey()))
                @foreach($grouped_comments[$comment->getKey()] as $child)
                    @include('comments::_comment', [
                        'comment' => $child,
                        'reply' => true,
                        'grouped_comments' => $grouped_comments
                    ])
                @endforeach
            @endif
            
        </div>
       

  
@if(isset($reply) && $reply === true)
  </div>
@else
  </li><hr>
@endif