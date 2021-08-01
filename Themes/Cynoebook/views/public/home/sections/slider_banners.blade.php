<div class="slider-banner">
    @if(!is_null($sliderBanners->image->path))
        @include('public.home.sections.partials.slider_banner', ['banner' => $sliderBanners,'class' => 'main_slider_banner'])
    @endif
</div>
