<?php

namespace Modules\Author\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Author\Entities\Author;
use Modules\Base\Http\Requests\Request;

class FrontSaveAuthorRequest extends Request
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
            'author_image' => 'nullable|mimes:jpeg,png,jpg',
            
        ];
    }

    private function getSlugRules()
    {
        $rules = $this->route()->getName() === 'account.authors.update'
            ? ['required']
            : ['nullable'];

        $slug = Author::withoutGlobalScope('active')->where('id', $this->id)->value('slug');

        $rules[] = Rule::unique('authors', 'slug')->ignore($slug, 'slug');

        return $rules;
    }
}
