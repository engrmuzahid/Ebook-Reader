<div class="ebook-card-list clearfix">
    <a class="ebook-image pull-left" href="{{ route('ebooks.show', $ebook->slug) }}">
        <ul class="ebook-ribbon list-inline">
             @if ($ebook->isPrivateEbook())
                    <li><span class="ribbon bg-red"><i class="fa fa-user-secret" aria-hidden="true"></i> {{ clean(trans('cynoebook::ebook_card.private')) }}</span></li>
                @endif
            @if ($ebook->isFeatured())
                    <li><span class="ribbon bg-green"><i class="fa fa-star" aria-hidden="true"></i> {{ clean(trans('cynoebook::ebook_card.featured')) }}</span></li>
            @endif
        </ul>

        @if (! $ebook->book_cover->exists)
            <div class="image-placeholder">
                <i class="fa fa-picture-o" aria-hidden="true"></i>
            </div>
        @else
            <div class="image-holder">
                <img src="{{ $ebook->book_cover->path }}">
            </div>
        @endif
    </a>
    <div class="ebook-content clearfix">
        <div class="ebook-content-inner">
            <a href="{{ route('ebooks.show', $ebook->slug) }}" class="ebook-name">
                <h5>
                @if($ebook->isPasswordProtected())
                    <i class="fa fa-lock has-error" aria-hidden="true" ></i>
                @endif
                {{ $ebook->title }}</h5>
            </a>
            <p>
                {{ clean(trans('cynoebook::ebook.authors')) }}: 
                @foreach ($ebook->authors as $author)
                    @if($author->is_verified && $author->is_active )
                        <a href="{{ route('authors.show', $author->slug)}}">{{ $author->name }}</a>
                    @else
                        {{ $author->name }}
                    @endif
                    {{ (!$loop->last) ? ', ' : ''}}
                @endforeach
            </p>
           
            
            <p><i class="fa fa-folder-o"></i> In 
                @foreach ($ebook->categories as $category)
                    <a href="{{ route('ebooks.index').'?category='.$category->slug.'&page=1'}}">{{ $category->name }}</a>{{ (!$loop->last) ? ', ' : ''}}
                @endforeach
            </p>
            <p>
            
                <i class="fa fa-user"></i> By 
                @if($ebook->user()->exists()) 
                    <a href="{{ route('user.profile.show',$ebook->user->username) }}">{{ $ebook->user->full_name }}</a>
                @else
                    {{ clean(trans('cynoebook::ebook_card.guest')) }}
                @endif
            
            </p>
            <p>
                @include('public.ebooks.partials.ebook.rating', ['rating' => $ebook->avgRating()])
            </p>  
            
            <p>{{ $ebook->short_description }}</p>
        </div>

        <div class="ebook-card-buttons">
            @if($ebook->isFavorite())
                <form method="POST" action="{{ route('account.favorite.destroy',$ebook) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="delete">   
                
                    <button type="submit" class="btn btn-favorite" data-toggle="tooltip" data-placement="{{ is_rtl() ? 'right' : 'left' }}" title="{{ clean(trans('cynoebook::ebook_card.remove_from_favorite')) }}">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    </button>
                </form>
            @else   
                <form method="POST" action="{{ route('favorite.store') }}">
                    {{ csrf_field() }}
                        
                    <input type="hidden" name="ebook_id" value="{{ $ebook->id }}">
                        <button type="submit" class="btn btn-favorite" data-toggle="tooltip" data-placement="{{ is_rtl() ? 'right' : 'left' }}" title="{{ clean(trans('cynoebook::ebook_card.add_to_favorite')) }}">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                    </button>
                </form>
            @endif 
                
            <a href="{{ route('ebooks.show', ['slug' => $ebook->slug]) }}" class="btn">
                {{ clean(trans('cynoebook::ebook_card.view_details')) }}
            </a>
            
            @if(auth()->user())
                @if ($ebook->user_id==auth()->user()->id)
                    <a href="{{ route('ebooks.edit', ['slug' => $ebook->slug]) }}" class="btn btn-icon btn-icon-mini btn-round" data-toggle="tooltip" data-placement="{{ is_rtl() ? 'left' : 'right' }}" title="{{ clean(trans('cynoebook::account.ebooks.edit_ebook')) }}">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                        
                    <a href="{{ route('ebooks.delete', ['slug' => $ebook->slug]) }}" class="btn btn-icon  btn-icon-mini btn-round btn-sm" data-toggle="tooltip" data-placement="{{ is_rtl() ? 'left' : 'right' }}" title="{{ clean(trans('cynoebook::account.ebooks.delete_ebook')) }}" onclick="return confirm('{{ clean(trans('cynoebook::account.ebooks.delete_confirm_message')) }}')">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                @endif
            @endif
        </div>
    </div>
</div>
