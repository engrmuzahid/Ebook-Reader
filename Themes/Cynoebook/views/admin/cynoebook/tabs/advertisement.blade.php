{{ Form::checkbox('cynoebook_ad1_section_enabled', clean(trans('cynoebook::attributes.section_status')), clean(trans('cynoebook::cynoebook.form.enable_ad1_section')), $errors, $settings) }}

<div class="media-picker-divider"></div>

<h4 class="section-title">{{ clean(trans('cynoebook::cynoebook.form.advertisement_1')) }}</h4>
{{ Form::textarea('cynoebook_ad_1', '', $errors, $settings,['labelCol' => 0]) }}

<div class="media-picker-divider"></div>

{{ Form::checkbox('cynoebook_ad2_section_enabled', clean(trans('cynoebook::attributes.section_status')), clean(trans('cynoebook::cynoebook.form.enable_ad2_section')), $errors, $settings) }}

<h4 class="section-title">{{ clean(trans('cynoebook::cynoebook.form.advertisement_2')) }}</h4>
{{ Form::textarea('cynoebook_ad_2', '', $errors, $settings,['labelCol' => 0]) }}

<div class="media-picker-divider"></div>
        
{{ Form::checkbox('cynoebook_ad3_section_enabled', clean(trans('cynoebook::attributes.section_status')), clean(trans('cynoebook::cynoebook.form.enable_ad3_section')), $errors, $settings) }}
<h4 class="section-title">{{ clean(trans('cynoebook::cynoebook.form.advertisement_3')) }}</h4>
{{ Form::textarea('cynoebook_ad_3', '', $errors, $settings,['labelCol' => 0]) }}
        
