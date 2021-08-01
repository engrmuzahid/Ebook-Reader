<?php

namespace Modules\Ebook\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Ebook\Entities\ReportedEbook;
use Modules\Admin\Traits\HasDefaultActions;

class ReportedEbookController extends Controller
{
   use HasDefaultActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = ReportedEbook::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'ebook::reportedebooks.ebook';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'ebook::admin.reportedebooks';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    //protected $validation = SaveEbookRequest::class;
}
