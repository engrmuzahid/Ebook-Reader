@extends('public.layout')

@section('title', setting('site_name'))

@section('content')
    
    @if (cynoebook_layout() === 'default')
        <div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3">
            <div class="row">
                @include('public.home.sections.slider_banners')
            </div>
        </div>
        <div class="clearfix"></div>
    @elseif (cynoebook_layout() === 'slider_layout')
        @if(!is_null($slider))
            <div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3">
                <div class="row">
                     @include('public.home.sections.slider')
                </div>
            </div>
            <div class="clearfix"></div>
        @endif
    @endif

    @include('public.include.notification')
    
    @if (setting('cynoebook_home_ad1_section_enabled'))
     @include('public.home.sections.advertisement',['ad'=>$homeAdvertisement1])
    @endif
    
    {{-- @if (setting('cynoebook_features_section_enabled'))
        @include('public.home.sections.features')
    @endif --}}

    @if (setting('cynoebook_featured_ebooks_carousel_section_enabled'))
        @include('public.home.sections.ebook_carousel', [
            'title' => setting('cynoebook_featured_ebooks_section_title'),
            'ebooks' => $carouselEbooks
        ])
    @endif
    
    @if (setting('cynoebook_popular_ebooks_carousel_section_enabled'))
        @include('public.home.sections.ebook_carousel', [
            'title' => setting('cynoebook_popular_ebooks_section_title'),
            'ebooks' => $popularEbooks
        ])
    @endif
    
    @if (setting('cynoebook_banner_section_1_enabled'))
        @include('public.home.sections.banner_section_1')
    @endif
    
    @if (setting('cynoebook_authors_section_enabled'))
        @include('public.home.sections.authors_section')
    @endif
    
    @if (setting('cynoebook_home_ad2_section_enabled'))
        @include('public.home.sections.advertisement',['ad'=>$homeAdvertisement2])
    @endif
    
    @if (setting('cynoebook_recent_ebooks_section_enabled'))
        @include('public.home.sections.recent_ebooks')
    @endif
    
    @if (setting('cynoebook_banner_section_2_enabled'))
        @include('public.home.sections.banner_section_2')
    @endif
    
    @if (setting('cynoebook_category_tabs_section_enabled'))
        @include('public.home.sections.category_tabs')
    @endif
    
    @if (setting('cynoebook_home_ad3_section_enabled'))
        @include('public.home.sections.advertisement',['ad'=>$homeAdvertisement3])
    @endif
    
    @if (setting('cynoebook_users_section_enabled'))
        @include('public.home.sections.users_section')
    @endif

@endsection
