{{ Form::checkbox('cynoebook_features_section_enabled', clean(trans('cynoebook::attributes.section_status')), clean(trans('cynoebook::cynoebook.form.enable_features_section')), $errors, $settings) }}
<div class="media-picker-divider"></div>
        
<h4 class="section-title">{{ clean(trans('cynoebook::cynoebook.form.feature_1')) }}</h4>

{{ Form::text('cynoebook_feature_1_icon', clean(trans('cynoebook::attributes.icon')), $errors, $settings) }}
{{ Form::text('translatable[cynoebook_feature_1_title]', clean(trans('cynoebook::attributes.title')), $errors, $settings) }}
{{ Form::text('translatable[cynoebook_feature_1_subtitle]', clean(trans('cynoebook::attributes.subtitle')), $errors, $settings) }}

<div class="media-picker-divider"></div>

<h4 class="section-title">{{ clean(trans('cynoebook::cynoebook.form.feature_2')) }}</h4>

{{ Form::text('cynoebook_feature_2_icon', clean(trans('cynoebook::attributes.icon')), $errors, $settings) }}
{{ Form::text('translatable[cynoebook_feature_2_title]', clean(trans('cynoebook::attributes.title')), $errors, $settings) }}
{{ Form::text('translatable[cynoebook_feature_2_subtitle]', clean(trans('cynoebook::attributes.subtitle')), $errors, $settings) }}

<div class="media-picker-divider"></div>

<h4 class="section-title">{{ clean(trans('cynoebook::cynoebook.form.feature_3')) }}</h4>

{{ Form::text('cynoebook_feature_3_icon', clean(trans('cynoebook::attributes.icon')), $errors, $settings) }}
{{ Form::text('translatable[cynoebook_feature_3_title]', clean(trans('cynoebook::attributes.title')), $errors, $settings) }}
{{ Form::text('translatable[cynoebook_feature_3_subtitle]', clean(trans('cynoebook::attributes.subtitle')), $errors, $settings) }}

<div class="media-picker-divider"></div>

<h4 class="section-title">{{ clean(trans('cynoebook::cynoebook.form.feature_4')) }}</h4>

{{ Form::text('cynoebook_feature_4_icon', clean(trans('cynoebook::attributes.icon')), $errors, $settings) }}
{{ Form::text('translatable[cynoebook_feature_4_title]', clean(trans('cynoebook::attributes.title')), $errors, $settings) }}
{{ Form::text('translatable[cynoebook_feature_4_subtitle]', clean(trans('cynoebook::attributes.subtitle')), $errors, $settings) }}
       
