{{ Form::text('name', clean(trans('author::attributes.name')), $errors, $author, ['required' => true]) }}
@if (request()->routeIs('admin.authors.edit'))
    {{ Form::text('slug', clean(trans('author::attributes.slug')), $errors,$author,['required' => true]) }}
@endif

@include('files::admin.image_picker.single', [
    'title' => clean(trans('author::attributes.image')),
    'inputName' => 'files[author_image]',
    'file' => $author->author_image,
])

{{ Form::wysiwyg('description', clean(trans('author::attributes.description')), $errors, $author, []) }}

{{ Form::checkbox('is_active', clean(trans('author::attributes.is_active')), clean(trans('author::authors.form.enable_the_author')), $errors, $author) }}

{{ Form::checkbox('is_verified', clean(trans('author::attributes.is_verified')), clean(trans('author::authors.form.verified_the_author')), $errors, $author) }}
        
    