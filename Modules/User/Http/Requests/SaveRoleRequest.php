<?php

namespace Modules\User\Http\Requests;

use Modules\Base\Http\Requests\Request;
use Modules\User\Entities\Role;
use Illuminate\Validation\Rule;

class SaveRoleRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'user::attributes.roles';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:10',
            'slug' => $this->getSlugRules(),
        ];
    }
    
    private function getSlugRules()
    {
        $rules = $this->route()->getName() === 'admin.roles.update'
            ? ['required']
            : ['sometimes'];

        $slug = Role::withoutGlobalScope('active')->where('id', $this->id)->value('slug');

        $rules[] = Rule::unique('roles', 'slug')->ignore($slug, 'slug');

        return $rules;
    }
}
