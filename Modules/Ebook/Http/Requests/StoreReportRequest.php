<?php

namespace Modules\Ebook\Http\Requests;

use Modules\Base\Http\Requests\Request;

class StoreReportRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reason' => 'required|min:10',
        ];
    }
}
