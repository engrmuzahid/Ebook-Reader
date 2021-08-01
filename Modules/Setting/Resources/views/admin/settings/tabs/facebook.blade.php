{{ Form::checkbox('facebook_login_enabled', clean(trans('setting::attributes.facebook_login_enabled')), clean(trans('setting::settings.form.enable_facebook_login')), $errors, $settings) }}
{{ Form::text('facebook_login_app_id', clean(trans('setting::attributes.facebook_login_app_id')), $errors, $settings, ['required' => true]) }}
{{ Form::password('facebook_login_app_secret', clean(trans('setting::attributes.facebook_login_app_secret')), $errors, $settings, ['required' => true]) }}
        
    