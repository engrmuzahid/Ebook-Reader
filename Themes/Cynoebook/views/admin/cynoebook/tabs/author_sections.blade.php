{{ Form::checkbox('cynoebook_authors_section_enabled', clean(trans('cynoebook::attributes.section_status')), clean(trans('cynoebook::cynoebook.form.enable_authors_section')), $errors, $settings) }}
{{ Form::select('cynoebook_authors_order_by', clean(trans('cynoebook::attributes.authors_order_by')), $errors, clean(trans('cynoebook::attributes.authors_order_by_option')), $settings) }}    
{{ Form::text('translatable[cynoebook_authors_section_title]', clean(trans('cynoebook::attributes.section_title')), $errors, $settings) }}
{{ Form::number('cynoebook_authors_section_total_authors', clean(trans('cynoebook::attributes.total_authors')), $errors, $settings, ['min' => 0]) }}

