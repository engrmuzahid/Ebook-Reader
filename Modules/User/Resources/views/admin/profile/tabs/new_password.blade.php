{{ Form::password('password', clean(trans('user::attributes.users.new_password')), $errors) }}
{{ Form::password('password_confirmation', clean(trans('user::attributes.users.new_password_confirmation')), $errors) }}
  