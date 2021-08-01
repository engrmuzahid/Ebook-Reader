<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
    <div class="ebook-image">
        <ul class="ebook-ribbon hidden-xs">
            @if ($ebook->isPrivateEbook())
                <li><span class="ribbon bg-red"><i class="fa fa-user-secret" aria-hidden="true"></i> {{ clean(trans('cynoebook::ebook_card.private')) }}</span></li>
            @endif
            @if ($ebook->isFeatured())
                <li><span class="ribbon bg-green"><i class="fa fa-star" aria-hidden="true"></i> {{ clean(trans('cynoebook::ebook_card.featured')) }}</span></li>
            @endif
        </ul>
        <div class="base-image">
            @if (! $ebook->book_cover->exists)
                <div class="image-placeholder">
                    <i class="fa fa-picture-o"></i>
                </div>
            @else
                <a class="base-image-inner" href="{{ $ebook->book_cover->path }}">
                    <img src="{{ $ebook->book_cover->path }}" alt="{{ $ebook->name }}">
                </a>
            @endif
        </div>
    </div>
    <div class="social-share-btn">
            <ul class="list-inline social-links">
                <li>
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" >
                        <i class="fa fa-facebook-official" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="https://twitter.com/intent/tweet?text={{ $ebook->title }}&url={{ url()->current() }}">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $ebook->title }}">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="ttp://www.reddit.com/submit?url={{ url()->current() }}">
                        <i class="fa fa-reddit-alien" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}&media={{ $ebook->book_cover->path }}&description={{ $ebook->title }}" target="_blank">
                        <i class="fa fa-pinterest" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="mailto:?subject=eBook-{{$ebook->title}}&amp;body=Check out this eBook {{ route('ebooks.show', $ebook->slug) }}" ><i class="fa fa-envelope"></i></a>
                    
                </li>
            </ul>
        </div>
    
</div>
