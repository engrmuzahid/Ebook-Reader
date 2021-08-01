<?php

namespace Modules\User\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Http\Requests\Request;

class SaveUserRequest extends Request
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
        return [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'username' => ['required','alpha_dash', $this->userNameUniqueRule()],
            'email' => ['required', 'email', $this->emailUniqueRule()],
            'password' => 'nullable|confirmed|min:6',
            'roles' => ['required', Rule::exists('roles', 'id')],
            
        ];
    }

    private function emailUniqueRule()
    {
        $rule = Rule::unique('users');

        if ($this->route()->getName() === 'admin.users.update') {
            $userId = $this->route()->parameter('id');

            return $rule->ignore($userId);
        }

        return $rule;
    }
    private function userNameUniqueRule()
    {
        $rule = 'unique:users,username';

        if ($this->route()->getName() === 'admin.users.update') {
            $userId = $this->route()->parameter('id');

            return 'unique:users,username,'.$userId;
        }

        return $rule;
    }
}

