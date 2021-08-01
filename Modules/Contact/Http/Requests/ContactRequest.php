<?php

namespace Modules\Contact\Http\Requests;

use Modules\Base\Http\Requests\Request;

class ContactRequest extends Request
{
    protected $availableAttributes = 'contact::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'subject' => ['required'],
            'message' => ['required'],
            'captcha' => ['required', 'captcha'],
        ];
    }
}
