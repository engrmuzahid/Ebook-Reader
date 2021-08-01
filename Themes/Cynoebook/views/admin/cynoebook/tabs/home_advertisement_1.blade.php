{{ Form::checkbox('cynoebook_home_ad1_section_enabled', clean(trans('cynoebook::attributes.section_status')), clean(trans('cynoebook::cynoebook.form.enable_home_ad1_section')), $errors, $settings) }}
<h4 class="section-title">{{ clean(trans('cynoebook::cynoebook.form.advertisement_1')) }}</h4>
{{ Form::textarea('cynoebook_home_ad_1', '', $errors, $settings,['labelCol' => 0]) }}
