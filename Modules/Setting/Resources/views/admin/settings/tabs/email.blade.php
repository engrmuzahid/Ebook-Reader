{{ Form::text('email_from_address', clean(trans('setting::attributes.email_from_address')), $errors, $settings) }}
{{ Form::text('email_from_name', clean(trans('setting::attributes.email_from_name')), $errors, $settings) }}
{{ Form::text('email_host', clean(trans('setting::attributes.email_host')), $errors, $settings) }}
{{ Form::text('email_port', clean(trans('setting::attributes.email_port')), $errors, $settings) }}
{{ Form::text('email_username', clean(trans('setting::attributes.email_username')), $errors, $settings) }}
{{ Form::password('email_password', clean(trans('setting::attributes.email_password')), $errors, $settings) }}
{{ Form::select('email_encryption', clean(trans('setting::attributes.email_encryption')), $errors, $encryptionProtocols, $settings) }}
   