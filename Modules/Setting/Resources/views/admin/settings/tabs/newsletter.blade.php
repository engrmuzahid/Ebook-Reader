{{ Form::checkbox('newsletter_enabled', trans('setting::attributes.newsletter_enabled'), trans('setting::settings.form.allow_customers_to_subscribe'), $errors, $settings) }}
{{ Form::select('newsletter_display', clean(trans('setting::attributes.newsletter_display')), $errors, trans('setting::settings.form.newsletterDisplay'), $settings) }}
{{ Form::password('mailchimp_api_key', trans('setting::attributes.mailchimp_api_key'), $errors, $settings) }}
{{ Form::text('mailchimp_list_id', trans('setting::attributes.mailchimp_list_id'), $errors, $settings) }}
@include('files::admin.image_picker.single', [
    'title' => trans('setting::settings.form.newsletter_popup_image'),
    'inputName' => 'newsletter_bg_image',
    'file' => $newsletterBgImage,
])