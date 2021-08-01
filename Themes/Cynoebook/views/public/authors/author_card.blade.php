<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <div class="our-author">
        <div class="picture">
            @if ( ! $author->author_image->exists)
                {{ Theme::image('public/images/default-user-image.png') }}    
           
            @else
                <img class="img-fluid" src="{{ $author->author_image->path }}">
            @endif
        </div>
        <div class="author-content">
            <h4 class="name"><a href="{{ route('authors.show', $author->slug)}}" class="" aria-hidden="true">{{ $author->name }}</a></h4>
            <h5 class="total">
            {{ intl_number($author->ebooks_count) }} {{ trans_choice('author::authors.books_found', $author->ebooks_count) }}
            
            </h5>
        </div>
        <ul class="social">
            <li><a href="{{ route('authors.show', $author->slug)}}" class="" aria-hidden="true">{{ clean(trans('author::authors.view_details')) }}</a></li>
            
        </ul>
    </div>
</div>
                       