{{ Form::checkbox('enable_ebook_upload', clean(trans('setting::attributes.enable_ebook_upload')), clean(trans('setting::settings.form.allow_user_to_upload_new_eBook_from_frontend')), $errors, $settings) }}
{{ Form::checkbox('auto_approve_ebook', clean(trans('setting::attributes.auto_approve_ebook')), clean(trans('setting::settings.form.auto_approve_ebook_after_upload')), $errors, $settings) }}
{{ Form::checkbox('auto_approve_reviews', clean(trans('setting::attributes.auto_approve_reviews')), clean(trans('setting::settings.form.approve_reviews_automatically')), $errors, $settings) }}

{{ Form::checkbox('enable_ebook_report', clean(trans('setting::attributes.enable_ebook_report')), '', $errors, $settings) }}
{{-- Form::checkbox('enable_ebook_print', clean(trans('setting::attributes.enable_ebook_print')), '', $errors, $settings) --}}
{{ Form::checkbox('enable_ebook_download', clean(trans('setting::attributes.enable_ebook_download')), '', $errors, $settings) }}
{{ Form::checkbox('member_only_reading_books', clean(trans('setting::attributes.member_only_reading_books')), clean(trans('setting::settings.form.user_must_be_login_into_their_account_to_read_the_book')), $errors, $settings) }}
{{ Form::checkbox('enable_comment', clean(trans('setting::attributes.enable_comment')), clean(trans('setting::settings.form.allow_user_to_comment_on_ebooks')), $errors, $settings) }}
{{ Form::select('ebook_vide_mode', clean(trans('setting::attributes.ebook_vide_mode')), $errors, clean(trans('setting::settings.form.ebook_vide_mode_options')), $settings) }}