{{ Form::text('name', clean(trans('user::attributes.roles.name')), $errors, $role, ['required' => true]) }}
@if ($role->slug ?? false)
    {{ Form::text('slug', clean(trans('user::attributes.roles.slug')), $errors, $role, ['required' => true]) }}
@endif

    
