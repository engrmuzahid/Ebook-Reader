<?php

namespace Modules\Files\Http\Requests;

use Modules\Base\Http\Requests\Request;

class UploadFilesRequest extends Request
{
    public function rules()
    {
        return ['file' => 'file'];
    }
}
