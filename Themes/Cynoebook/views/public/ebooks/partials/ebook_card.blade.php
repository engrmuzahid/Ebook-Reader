<a href="{{ route('ebooks.show', $ebook->slug) }}" class="ebook-card">
    <div class="ebook-card-inner">
        <div class="ebook-image clearfix">
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
            @if(auth()->user())
            <div class="hover-action">
                @if ($ebook->user_id==auth()->user()->id)
                    <form method="GET" action="{{ route('ebooks.edit', ['slug' => $ebook->slug]) }}">
                        
                        <button type="submit" class="btn btn-icon btn-icon-mini btn-round btn-primary" data-toggle="tooltip" data-placement="{{ is_rtl() ? 'left' : 'right' }}" title="{{ clean(trans('cynoebook::account.ebooks.edit_ebook')) }}">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </form>
                    <form method="GET" action="{{ route('ebooks.delete', ['slug' => $ebook->slug]) }}" onsubmit="return confirm('{{ clean(trans('cynoebook::account.ebooks.delete_confirm_message')) }}')">
                        {{ csrf_field() }}
                            
                        <button type="submit" class="btn btn-icon btn-icon-mini btn-round btn-danger" data-toggle="tooltip" data-placement="{{ is_rtl() ? 'left' : 'right' }}" title="{{ clean(trans('cynoebook::account.ebooks.delete_ebook')) }}">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </form>
                    
                @endif
                
            </div>
            @endif
        </div>

        <div class="ebook-content clearfix">
            <span class="ebook-name div-ellipsis">
                @if($ebook->isPasswordProtected())
                    <i class="fa fa-lock has-error" aria-hidden="true" ></i>
                @endif
                {{ mb_strimwidth($ebook->title, 0, 35, "...") }}
            </span>
            <span class="ebook-name div-ellipsis ebook-authors">
            {{ clean(trans('cynoebook::ebook.authors')) }}: 
            {{ mb_strimwidth($ebook->getAuthors(), 0, 28, "...") }}
            </span>
            
        </div>
        
        <div class="more-details-wrapper">
            
            @if($ebook->isFavorite())
                <form method="POST" action="{{ route('account.favorite.destroy',$ebook) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="delete">   
                
                    <button type="submit" class="btn btn-favorite" data-toggle="tooltip" data-placement="{{ is_rtl() ? 'left' : 'right' }}" title="{{ clean(trans('cynoebook::ebook_card.remove_from_favorite')) }}">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    </button>
                </form>
            @else   
            <form method="POST" action="{{ route('favorite.store') }}">
                {{ csrf_field() }}
                    
                <input type="hidden" name="ebook_id" value="{{ $ebook->id }}">
                    <button type="submit" class="btn btn-favorite" data-toggle="tooltip" data-placement="{{ is_rtl() ? 'left' : 'right' }}" title="{{ clean(trans('cynoebook::ebook_card.add_to_favorite')) }}">
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                </button>
            </form>
            @endif 
            @include('public.ebooks.partials.ebook.rating', ['rating' => $ebook->avgRating()])
            <div class="div-ellipsis ebook-category" data-toggle="tooltip" data-placement="top" title="{{ $ebook->implodeCategories() }}">
                <i class="fa fa-folder-o"></i> In {{mb_strimwidth($ebook->implodeCategories(), 0, 10, "...") }}
            </div>
        </div>
    </div>
</a>

