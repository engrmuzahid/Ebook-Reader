<a href="{{ $banner->call_to_action_url }}" class="banner {{ $class ?? '' }}" style="background-image: url({{ $banner->image->path }});" target="{{ $banner->open_in_new_window ? '_blank' : '_self' }}">
    <div class="overlay"></div>

    <div class="display-table">
        <div class="display-table-cell">
            <div class="banner-content">
                <h1>{{ $banner->caption_1 }}</h1>
                <h3>{{ $banner->caption_2 }}</h3>
                <span>
                    {{ $banner->call_to_action_text }}
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                </span>
            </div>
        </div>
    </div>
</a>
