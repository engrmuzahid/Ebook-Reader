{{ Form::wysiwyg('description', clean(trans('ebook::attributes.description')), $errors, $ebook, ['required' => true]) }}

{{ Form::textarea('short_description', clean(trans('ebook::attributes.short_description')), $errors, $ebook, ['rows' => 2,]) }}