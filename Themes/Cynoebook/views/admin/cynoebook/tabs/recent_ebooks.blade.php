{{ Form::checkbox('cynoebook_recent_ebooks_section_enabled', clean(trans('cynoebook::attributes.section_status')), clean(trans('cynoebook::cynoebook.form.enable_recent_ebooks_section')), $errors, $settings) }}
{{ Form::text('translatable[cynoebook_recent_ebooks_section_title]', clean(trans('cynoebook::attributes.section_title')), $errors, $settings) }}
{{ Form::number('cynoebook_recent_ebooks_section_total_ebooks', clean(trans('cynoebook::attributes.total_ebooks')), $errors, $settings, ['min' => 0]) }}
    