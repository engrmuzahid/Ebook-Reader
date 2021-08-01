<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
    <div class="ebook-details">
        <h2 class="ebook-name">
        @if($ebook->isPasswordProtected())
            <i class="fa fa-lock has-error" aria-hidden="true" ></i>
        @endif
        
        {{ $ebook->title }}
         <div class="clearfix"></div>   
        </h2>
        <div class="ebook-statistics m-b-10">
            @if (setting('reviews_enabled'))
                @include('public.ebooks.partials.ebook.rating', ['rating' => $ebook->avgRating()])
                
                <span class="ebook-review pull-left">
                    ({{ intl_number($ebook->reviews->count()) }} {{ clean(trans('cynoebook::ebook.user_reviews')) }})
                </span>
            @endif
            
            <span class="ebook-view pull-left" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.views')) }}">
                <i class="fa fa-eye"></i> &nbsp; {{ $ebook->viewed}}
            </span>
            @if (setting('enable_ebook_download'))
                @if( $ebook->file_type!='embed_code' )
                <span class="ebook-download ebook-incat pull-left" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}">
                    <i class="fa fa-download"></i> &nbsp; {{ $ebook->download}}
                </span>
                @endif
            @endif
            <div class="clearfix"></div> 
        </div>
        <div class="clearfix"></div> 
        <div class="ebook-byinon m-b-10">
            <span class="ebook-user pull-left">{{clean(trans('cynoebook::ebook.by'))}} 
            @if($ebook->user()->exists())
                <a href="{{ route('user.profile.show',$ebook->user->username) }}">{{ $ebook->user->full_name }}</a>
            @else
                {{ clean(trans('cynoebook::ebook_card.guest')) }}
            @endif
            </span>
            
            <span class="ebook-on pull-left"> {{clean(trans('cynoebook::ebook.posted_on'))}} <a href="#">{{ $ebook->created_at->toFormattedDateString() }}</a></span>
            <div class="clearfix"></div> 
            <span class="ebook-incat pull-left ">
                {{clean(trans('cynoebook::ebook.in_category'))}} -  
                @foreach ($ebook->categories as $category)
                    <a href="{{ route('ebooks.index').'?category='.$category->slug.'&page=1'}}">
                        {{ $category->name }}{{ (!$loop->last) ? ', ' : ''}}
                    </a>
                @endforeach
            </span>
            <div class="clearfix"></div> 
        </div>
        <div class="clearfix"></div> 
        <div class="ebook-other m-b-10">
        
            <span class="ebook-authors show"> 
                <label>{{ trans('cynoebook::ebook.authors') }}:</label>
                 @foreach ($ebook->authors as $author)
                    @if($author->is_verified && $author->is_active )
                        <a href="{{ route('authors.show', $author->slug)}}">{{ $author->name }}</a>{{ (!$loop->last) ? ', ' : ''}}
                    @else
                        {{ $author->name }}{{ (!$loop->last) ? ', ' : ''}}
                    @endif
                    
                @endforeach
            </span>
        
            @if (! is_null($ebook->isbn))
                <span class="ebook-isbn-number show "> 
                    <label>{{ trans('cynoebook::ebook.isbn_number') }}:</label>
                    {{ $ebook->isbn }}
                </span>
            @endif
        
            @if (! is_null($ebook->publisher))
                <span class="ebook-publisher pull-left "> 
                    <label>{{ trans('cynoebook::ebook.published_by') }}:</label>
                    {{ $ebook->publisher }}
                </span>
            @endif
        
            @if (! is_null($ebook->publication_year))
            <span class="ebook-publication-year pull-left "> 
                <label>{{ trans('cynoebook::ebook.in_year') }}:</label>
                {{ $ebook->publication_year }}
            </span>
            @endif
            <div class="clearfix"></div> 
        </div>
        <div class="clearfix"></div> 
        @if (! is_null($ebook->short_description))
            <div class="ebook-brief">{{ $ebook->short_description }}</div>
            <div class="clearfix"></div>
        @endif 
        <div class="ebook-action m-b-10"> 
            @if (! is_null($ebook->buy_url))
                <a href="{{ $ebook->buy_url }}" target="_blank" class="btn btn-primary pull-left">
                    {{clean(trans('cynoebook::ebook.buy_now'))}}
                    @if (! is_null($ebook->price))
                    {{ $ebook->price }}
                    @endif
                </a>
            @endif
            <div class="pull-right">
                
                <span class="pull-left" style="margin-right: 5px;">
                    
                    @if($ebook->isFavorite())
                        <form method="POST" action="{{ route('account.favorite.destroy',$ebook) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="delete">   
                        
                            <button type="submit" class="btn btn-favorite btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook_card.remove_from_favorite')) }}">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                            </button>
                        </form>
                    @else   
                        <form method="POST" action="{{ route('favorite.store') }}">
                            {{ csrf_field() }}
                                
                            <input type="hidden" name="ebook_id" value="{{ $ebook->id }}">
                                <button type="submit" class="btn btn-favorite btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook_card.add_to_favorite')) }}">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </button>
                        </form>
                    @endif  
                </span>
                
            
                @if (setting('enable_ebook_report'))
                    @auth
                    <button type="button" id="btn-reportBook" class="btn btn-primary btn-sm btn-right-actions"  data-target="#reportBook" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.report')) }}"><i class="fa fa-flag" aria-hidden="true" ></i></button>
                    @include('public.ebooks.partials.ebook.report.report')
                    @endauth
                @endif
            
                
                @if ($ebook->password=='' &&  $unlock)
                    @if (setting('enable_ebook_print_dis'))
                        <button type="button" class="btn btn-primary btn-sm btin-print" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.print')) }}"><i class="fa fa-print" aria-hidden="true" ></i></button>
                    @endif
                    @if (setting('enable_ebook_download'))
                        @if($ebook->file_type=='upload' )
                            <a class="btn btn-primary btn-sm" href="{{ route('ebooks.download',[$ebook->slug,id_encode($ebook->book_file->id)])}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}"><i class="fa fa-download" aria-hidden="true" ></i></a>
                        @endif
                        @if( $ebook->file_type=='external_link')
                            <a class="btn btn-primary btn-sm" href="{{ route('ebooks.download',$ebook->slug)}}" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::ebook.download')) }}"><i class="fa fa-download" aria-hidden="true" ></i></a>
                        @endif
                    @endif
                @endif
                @if(auth()->user())
                    @if ($ebook->user_id==auth()->user()->id)
                        <a href="{{ route('ebooks.edit', ['slug' => $ebook->slug]) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::account.ebooks.edit_ebook')) }}">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                            
                        <a href="{{ route('ebooks.delete', ['slug' => $ebook->slug]) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ clean(trans('cynoebook::account.ebooks.delete_ebook')) }}" onclick="return confirm('{{ clean(trans('cynoebook::account.ebooks.delete_confirm_message')) }}')">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    @endif
                @endif
                
            </div>
            <div class="clearfix"></div>
        </div> 
        
    </div>
</div>
@push('scripts')
<script>
    function PrintPDF(elem)
    {
        var objFra = document.getElementsByClassName(elem);
        objFra.contentWindow.focus();
        objFra.contentWindow.print();
    }
    (function () {
        "use strict";
        
        
        $(document).ready(function(){
            @if(report_form_has_error($errors))
                $('body').append('<div class="right-actions-overlay"></div>');
                $("#reportBook").addClass('open');
                $(".right-actions-overlay").show();
            @endif
        }); 
    })();     
    
</script>
@endpush