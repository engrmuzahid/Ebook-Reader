<?php

namespace Modules\User\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Http\Requests\Request;

class UpdateProfileRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'user::attributes.users';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = auth()->id();

        return [
            'email' => ['required','email', Rule::unique('users')->ignore(auth()->id())],
            'username' => ['required','alpha_dash','unique:users,username,'.auth()->id()],
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'password' => 'confirmed',
            'avatar' => 'mimes:jpeg,png,jpg',
        ];
    }
}
