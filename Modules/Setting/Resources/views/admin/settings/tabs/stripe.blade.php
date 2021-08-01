{{ Form::checkbox('stripe_enabled', trans('setting::attributes.stripe_enabled'), trans('setting::settings.form.enable_stripe'), $errors, $settings) }}

{{ Form::text('stripe_publishable_key', trans('setting::attributes.stripe_publishable_key'), $errors, $settings, ['required' => true]) }}
{{ Form::password('stripe_secret_key', trans('setting::attributes.stripe_secret_key'), $errors, $settings, ['required' => true]) }}

