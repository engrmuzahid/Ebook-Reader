<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class InstallerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'db.host' => 'required',
            'db.port' => 'required',
            'db.username' => 'required',
            'db.password' => 'nullable',
            'db.database' => 'required',
            'admin.first_name' => 'required|max:50',
            'admin.last_name' => 'required|max:50',
            'admin.username' => 'required',
            'admin.email' => 'required|email',
            'admin.password' => 'required|confirmed',
            'site.site_name' => 'required',
            'site.site_email' => 'required|email',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => 'The :attribute field is required.',
            '*.required_if' => 'The :attribute field is required when :other is :value.',
            '*.email' => 'The :attribute must be a valid email address.',
            '*.unique' => 'The :attribute has already been taken.',
            '*.confirmed' => 'The :attribute confirmation does not match.',
            '*.max'                  => [
                'numeric' => 'The :attribute may not be greater than :max.',
                'file'    => 'The :attribute may not be greater than :max kilobytes.',
                'string'  => 'The :attribute may not be greater than :max characters.',
                'array'   => 'The :attribute may not have more than :max items.',
            ],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'db.host' => 'host',
            'db.port' => 'port',
            'db.username' => 'username',
            'db.password' => 'password',
            'db.database' => 'datbase',
            'admin.first_name' => 'first name',
            'admin.last_name' => 'last name',
            'admin.username' => 'User name',
            'admin.email' => 'email',
            'admin.password' => 'password',
            'site.site_name' => 'Site name',
            'site.site_email' => 'Site email',
            
        ];
    }
}
