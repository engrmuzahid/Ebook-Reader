{{ Form::checkbox('cynoebook_popular_ebooks_carousel_section_enabled', clean(trans('cynoebook::attributes.section_status')), clean(trans('cynoebook::cynoebook.form.enable_popular_ebooks_carousel_section')), $errors, $settings) }}
{{ Form::select('cynoebook_popular_ebooks_by', clean(trans('cynoebook::attributes.popular_ebooks_by')), $errors, clean(trans('cynoebook::popular')), $settings) }}    
{{ Form::text('translatable[cynoebook_popular_ebooks_section_title]', clean(trans('cynoebook::attributes.section_title')), $errors, $settings) }}
{{ Form::number('cynoebook_popular_ebooks_section_total_ebooks', clean(trans('cynoebook::attributes.total_ebooks')), $errors, $settings, ['min' => 0]) }}

