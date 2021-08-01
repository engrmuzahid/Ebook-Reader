
<a href="{{ $bannerSectionOneBanner->call_to_action_url }}" class="banner banner-lg" style="background-image: url({{ $bannerSectionOneBanner->image->path }});" target="{{ $bannerSectionOneBanner->open_in_new_window ? '_blank' : '_self' }}">
    <div class="overlay"></div>

    <div class="display-table">
        <div class="display-table-cell">
            <div class="banner-content">
                <h2>{{ $bannerSectionOneBanner->caption_1 }}</h2>
                <p>{{ $bannerSectionOneBanner->caption_2 }}</p>
                <span>
                    {{ $bannerSectionOneBanner->call_to_action_text }}
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                </span>
            </div>
        </div>
    </div>
</a>
