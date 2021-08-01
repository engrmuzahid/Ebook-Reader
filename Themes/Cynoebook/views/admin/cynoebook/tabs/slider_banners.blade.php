<div class="accordion-box-content">
    <div class="tab-content clearfix">
        <div class="banner-image-wrapper">
            @include('admin.cynoebook.tabs.include.single_banner', [
                'label' => clean(trans("cynoebook::cynoebook.form.banner")),
                'name' => 'cynoebook_slider_banner',
                'banner' => $banner,
            ])
        </div>
    </div>
</div>
