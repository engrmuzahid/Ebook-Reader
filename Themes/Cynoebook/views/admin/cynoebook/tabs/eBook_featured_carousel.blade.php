{{ Form::checkbox('cynoebook_featured_ebooks_carousel_section_enabled', clean(trans('cynoebook::attributes.section_status')), clean(trans('cynoebook::cynoebook.form.enable_featured_ebooks_carousel_section')), $errors, $settings) }}
{{ Form::text('translatable[cynoebook_featured_ebooks_section_title]', clean(trans('cynoebook::attributes.section_title')), $errors, $settings) }}
{{ Form::number('cynoebook_featured_ebooks_section_total_ebooks', clean(trans('cynoebook::attributes.total_ebooks')), $errors, $settings, ['min' => 0]) }}
    
