@include('files::admin.image_picker.single', [
    'title' => clean(trans('cynoebook::cynoebook.form.favicon')),
    'inputName' => 'cynoebook_favicon',
    'file' => $favicon,
])

<div class="media-picker-divider"></div>

@include('files::admin.image_picker.single', [
    'title' => clean(trans('cynoebook::cynoebook.form.header_logo')),
    'inputName' => 'translatable[cynoebook_header_logo]',
    'file' => $headerLogo,
])

<div class="media-picker-divider"></div>

@include('files::admin.image_picker.single', [
    'title' => clean(trans('cynoebook::cynoebook.form.footer_logo')),
    'inputName' => 'translatable[cynoebook_footer_logo]',
    'file' => $footerLogo,
])

<div class="media-picker-divider"></div>

@include('files::admin.image_picker.single', [
    'title' => clean(trans('cynoebook::cynoebook.form.mail_logo')),
    'inputName' => 'translatable[cynoebook_mail_logo]',
    'file' => $mailLogo,
])
