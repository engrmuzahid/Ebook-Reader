{{ Form::textarea('googleanalyticscode', clean(trans('setting::attributes.googleanalyticscode')), $errors, $settings) }}
{{ Form::textarea('custom_js', clean(trans('setting::attributes.custom_js')), $errors, $settings,['help'=>clean(trans('setting::attributes.custom_js_help'))]) }}
{{ Form::textarea('custom_css', clean(trans('setting::attributes.custom_css')), $errors, $settings,['help'=>clean(trans('setting::attributes.custom_css_help'))]) }}
    
