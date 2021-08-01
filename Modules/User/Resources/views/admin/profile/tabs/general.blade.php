{{ Form::text('first_name', clean(trans('user::attributes.users.first_name')), $errors, $currentUser, ['required' => true]) }}
{{ Form::text('last_name', clean(trans('user::attributes.users.last_name')), $errors, $currentUser, ['required' => true]) }}
{{ Form::text('username', clean(trans('user::attributes.users.username')), $errors, $currentUser, ['required' => true]) }}
{{ Form::email('email', clean(trans('user::attributes.users.email')), $errors, $currentUser, ['required' => true]) }}
    
