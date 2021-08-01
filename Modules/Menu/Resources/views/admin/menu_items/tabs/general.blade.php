{{ Form::text('name', clean(trans('menu::attributes.name')), $errors, $menuItem, ['required' => true]) }}
{{ Form::select('type', clean(trans('menu::attributes.type')), $errors, clean(trans('menu::menu_items.form.types')), $menuItem, ['required' => true]) }}

<div class="link-field category-field {{ old('type', $menuItem->type) !== 'category' ? 'd-none' :'' }}">
    {{ Form::select('category_id', clean(trans('menu::attributes.category_id')), $errors, $categories, $menuItem, ['required' => true]) }}
</div>

<div class="link-field page-field {{ old('type', $menuItem->type) !== 'page' ? 'd-none' :'' }}" >
    {{ Form::select('page_id', clean(trans('menu::attributes.page_id')), $errors, $pages, $menuItem, ['required' => true]) }}
</div>

<div class="link-field url-field {{ old('type', $menuItem->type ?? 'url') !== 'url' ? 'd-none' :'' }}">
    {{ Form::text('url', clean(trans('menu::attributes.url')), $errors, $menuItem, ['required' => true]) }}
</div>

{{ Form::checkbox('is_fluid', clean(trans('menu::attributes.is_fluid')), clean(trans('menu::menu_items.form.full_width_menu')), $errors, $menuItem) }}
{{ Form::select('target',clean( trans('menu::attributes.target')), $errors, clean(trans('menu::menu_items.form.targets')), $menuItem) }}
{{ Form::select('parent_id', clean(trans('menu::attributes.parent_id')), $errors, $parentMenuItems, $menuItem) }}
{{ Form::checkbox('is_active', clean(trans('menu::attributes.is_active')), clean(trans('menu::menu_items.form.enable_the_menu_item')), $errors, $menuItem) }}
    
