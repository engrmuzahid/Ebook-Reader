<?php

namespace Modules\Ebook\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Ebook\Entities\Ebook;
use Modules\Admin\Traits\HasDefaultActions;
use Modules\Ebook\Http\Requests\SaveEbookRequest;


class EbookController extends Controller
{
   use HasDefaultActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Ebook::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'ebook::ebooks.ebook';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'ebook::admin.ebooks';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveEbookRequest::class;
}
