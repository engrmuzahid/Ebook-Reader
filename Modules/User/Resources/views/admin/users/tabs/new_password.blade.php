
{{ Form::password('password', clean(trans('user::attributes.users.new_password')), $errors) }}
{{ Form::password('password_confirmation', clean(trans('user::attributes.users.new_password_confirmation')), $errors) }}
<hr>
<div class="text-center">
<h4>{{ clean(trans('user::users.or_send_email')) }}</h4>

<a href="{{ route('admin.users.reset_password', $user) }}" class="btn btn-primary btn-reset-password" data-loading>
    {{ clean(trans('user::users.send_email')) }}
</a>
</div>
    