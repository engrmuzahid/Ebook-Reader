{{ Form::checkbox('maintenance_mode', clean(trans('setting::attributes.maintenance_mode')), clean(trans('setting::settings.form.put_the_application_into_maintenance_mode')), $errors, $settings) }}
{{ Form::textarea('allowed_ips', clean(trans('setting::attributes.allowed_ips')), $errors, $settings, ['placeholder' => clean(trans('setting::settings.form.ip_addreses_seperated_in_new_line'))]) }}
    