{{ Form::checkbox('cynoebook_home_ad3_section_enabled', clean(trans('cynoebook::attributes.section_status')), clean(trans('cynoebook::cynoebook.form.enable_home_ad3_section')), $errors, $settings) }}
<h4 class="section-title">{{ clean(trans('cynoebook::cynoebook.form.advertisement_3')) }}</h4>
{{ Form::textarea('cynoebook_home_ad_3', '', $errors, $settings,['labelCol' => 0]) }}
       