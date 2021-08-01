<?php

namespace Modules\Setting\Http\Requests;

use Modules\Base\Helpers\Locale;
use Modules\Base\Helpers\TimeZone;
use Illuminate\Validation\Rule;
use Modules\Base\Http\Requests\Request;

class UpdateSettingRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'setting::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'translatable.site_name' => 'required',
            'site_email' => 'required|email',
            
            'supported_locales.*' => ['required', Rule::in(Locale::codes())],
            'default_locale' => 'required|in_array:supported_locales.*',
            'default_timezone' => ['required', Rule::in(TimeZone::all())],
            'user_role' => ['required', Rule::exists('roles', 'id')],
            
            'email_from_address' => 'nullable|email',
            'email_encryption' => ['nullable', Rule::in($this->emailEncryptionProtocols())],
            
            'newsletter_enabled' => ['required', 'boolean'],
            'mailchimp_api_key' => ['required_if:newsletter_enabled,1'],
            'mailchimp_list_id' => ['required_if:newsletter_enabled,1'],
            
            //'allowed_file_types' => 'required',
            'facebook_login_enabled' => 'required|boolean',
            'facebook_login_app_id' => 'required_if:facebook_login_enabled,1',
            'facebook_login_app_secret' => 'required_if:facebook_login_enabled,1',

            'google_login_enabled' => 'required|boolean',
            'google_login_client_id' => 'required_if:google_login_enabled,1',
            'google_login_client_secret' => 'required_if:google_login_enabled,1',
            
        ];
    }

    /**
     * Returns email encryption protocols.
     *
     * @return array
     */
    private function emailEncryptionProtocols()
    {
        return array_keys(clean(trans('setting::settings.form.email_encryption_protocols')));
    }
}
