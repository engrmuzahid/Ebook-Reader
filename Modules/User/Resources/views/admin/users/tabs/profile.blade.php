@include('files::admin.image_picker.single', [
    'title' => clean(trans('user::attributes.users.avatar')),
    'inputName' => 'files[avatar]',
    'file' => $user->avatar,
])
 
{{ Form::textarea('about', clean(trans('user::attributes.users.about')), $errors, $user) }}
{{ Form::text('facebook', clean(trans('user::attributes.users.facebook')), $errors, $user) }}
{{ Form::text('twitter', clean(trans('user::attributes.users.twitter')), $errors, $user) }}
{{ Form::text('google', clean(trans('user::attributes.users.google')), $errors, $user) }}
{{ Form::text('instagram', clean(trans('user::attributes.users.instagram')), $errors, $user) }}
{{ Form::text('linkedin', clean(trans('user::attributes.users.linkedin')), $errors, $user) }}
{{ Form::text('youtube', clean(trans('user::attributes.users.youtube')), $errors, $user) }}
        

    