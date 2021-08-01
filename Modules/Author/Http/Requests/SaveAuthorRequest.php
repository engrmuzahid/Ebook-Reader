<?php

namespace Modules\Author\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Author\Entities\Author;
use Modules\Base\Http\Requests\Request;

class SaveAuthorRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'Author::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => $this->getSlugRules(),
            'is_active' => 'required|boolean',
            'is_verified' => 'required|boolean',
        ];
    }

    private function getSlugRules()
    {
        $rules = $this->route()->getName() === 'admin.authors.update'
            ? ['required']
            : ['nullable'];

        $slug = Author::withoutGlobalScope('active')->where('id', $this->id)->value('slug');

        $rules[] = Rule::unique('authors', 'slug')->ignore($slug, 'slug');

        return $rules;
    }
}
