{{ Form::text('name', clean(trans('menu::attributes.name')), $errors, $menu, ['required' => true]) }}
{{ Form::checkbox('is_active', clean(trans('menu::attributes.is_active')), clean(trans('menu::menus.form.enable_the_menu')), $errors, $menu) }}
@if (!$menu->exists)
    <div class="alert alert-danger">
        {{ clean(trans('menu::menus.form.please_save_the_menu_first')) }}
    </div>
@endif