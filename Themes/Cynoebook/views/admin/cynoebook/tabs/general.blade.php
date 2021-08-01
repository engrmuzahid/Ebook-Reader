{{ Form::select('cynoebook_theme', clean(trans('cynoebook::attributes.cynoebook_theme')), $errors, clean(trans('cynoebook::themes')), $settings) }}
{{ Form::select('cynoebook_mail_theme', clean(trans('cynoebook::attributes.cynoebook_mail_theme')), $errors, clean(trans('cynoebook::themes')), $settings) }}
{{ Form::select('cynoebook_layout', clean(trans('cynoebook::attributes.cynoebook_layout')), $errors, clean(trans('cynoebook::layouts')), $settings) }}
{{ Form::select('cynoebook_slider', clean(trans('cynoebook::attributes.cynoebook_slider')), $errors, $sliders, $settings) }}
{{ Form::select('cynoebook_privacy_page', clean(trans('cynoebook::attributes.cynoebook_privacy_page')), $errors, $pages, $settings) }}
{{ Form::textarea('translatable[cynoebook_footer_summary]', clean(trans('cynoebook::attributes.cynoebook_footer_one')), $errors, $settings,['rows'=>3,'help'=>clean(trans('cynoebook::attributes.cynoebook_footer_summary'))]) }}
{{ Form::text('translatable[cynoebook_footer_two_title]', clean(trans('cynoebook::attributes.cynoebook_footer_two_title')), $errors, $settings) }}
{{ Form::wysiwyg('translatable[cynoebook_footer_two]', clean(trans('cynoebook::attributes.cynoebook_footer_two')), $errors, $settings,['rows'=>3]) }}
{{ Form::text('translatable[cynoebook_copyright_text]', clean(trans('cynoebook::attributes.cynoebook_copyright_text')), $errors, $settings) }}
    
