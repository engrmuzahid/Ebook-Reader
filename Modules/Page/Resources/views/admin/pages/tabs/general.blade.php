{{ Form::text('name', clean(trans('page::attributes.name')), $errors, $page, ['required' => true]) }}
{{ Form::wysiwyg('body', clean(trans('page::attributes.body')), $errors, $page, ['required' => true]) }}
{{ Form::checkbox('is_active', clean(trans('page::attributes.is_active')), clean(trans('page::pages.form.enable_the_page')), $errors, $page) }}
