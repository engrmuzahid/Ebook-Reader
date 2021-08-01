
<h4 class="section-title">{{ clean(trans('cynoebook::cynoebook.form.contact')) }}</h4>
{{ Form::wysiwyg('translatable[contact_info]', '', $errors, $settings, ['labelCol' => 0]) }}
            
        