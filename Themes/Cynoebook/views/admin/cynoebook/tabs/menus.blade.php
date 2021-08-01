{{ Form::select('cynoebook_primary_menu', clean(trans('cynoebook::attributes.cynoebook_primary_menu')), $errors, $menus, $settings) }}
{{ Form::text('translatable[cynoebook_category_menu_title]', clean(trans('cynoebook::attributes.cynoebook_category_menu_title')), $errors, $settings) }}
{{ Form::select('cynoebook_category_menu', clean(trans('cynoebook::attributes.cynoebook_category_menu')), $errors, $menus, $settings) }}
{{ Form::text('translatable[cynoebook_footer_menu_title_1]', clean(trans('cynoebook::attributes.cynoebook_footer_menu_title_1')), $errors, $settings) }}
{{ Form::select('cynoebook_footer_menu_1', clean(trans('cynoebook::attributes.cynoebook_footer_menu_1')), $errors, $menus, $settings) }}
{{ Form::text('translatable[cynoebook_footer_menu_title_2]', clean(trans('cynoebook::attributes.cynoebook_footer_menu_title_2')), $errors, $settings) }}
{{ Form::select('cynoebook_footer_menu_2', clean(trans('cynoebook::attributes.cynoebook_footer_menu_2')), $errors, $menus, $settings) }}
  