<?php

namespace Modules\Page\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Page\Entities\Page;
use Modules\Admin\Traits\HasDefaultActions;
use Modules\Page\Http\Requests\SavePageRequest;

class PageController extends Controller
{
    use HasDefaultActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'page::pages.page';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'page::admin.pages';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SavePageRequest::class;
}
