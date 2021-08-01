<?php

namespace Modules\Author\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Author\Entities\Author;
use Modules\Admin\Traits\HasDefaultActions;
use Modules\Author\Http\Requests\SaveAuthorRequest;

class AuthorController extends Controller
{
    use HasDefaultActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'author::authors.author';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'author::admin.authors';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveAuthorRequest::class;
}
