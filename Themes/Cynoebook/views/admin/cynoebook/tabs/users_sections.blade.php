{{ Form::checkbox('cynoebook_users_section_enabled', clean(trans('cynoebook::attributes.section_status')), clean(trans('cynoebook::cynoebook.form.enable_users_section')), $errors, $settings) }}
{{ Form::select('cynoebook_users_order_by', clean(trans('cynoebook::attributes.users_order_by')), $errors, clean(trans('cynoebook::attributes.users_order_by_option')), $settings) }}    
{{ Form::text('translatable[cynoebook_users_section_title]', clean(trans('cynoebook::attributes.section_title')), $errors, $settings) }}
{{ Form::number('cynoebook_users_section_total_authors', clean(trans('cynoebook::attributes.total_users')), $errors, $settings, ['min' => 0]) }}

