{{ Form::checkbox('cynoebook_banner_section_2_enabled', clean(trans('cynoebook::attributes.section_status')), clean(trans('cynoebook::cynoebook.form.enable_banner_section_2')), $errors, $settings) }}
    

<div class="accordion-box-content">
    <div class="tab-content clearfix">
        <div class="banner-image-wrapper">
            @include('admin.cynoebook.tabs.include.single_banner', [
                'label' => clean(trans("cynoebook::cynoebook.form.banner")),
                'name' => 'cynoebook_banner_section_2_banner',
            ])
        </div>
    </div>
</div>
