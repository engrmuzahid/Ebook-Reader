<?php

namespace Modules\Slider\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Admin\Traits\HasDefaultActions;
use Modules\Slider\Entities\Slider;
use Modules\Slider\Http\Requests\SaveSliderRequest;

class SliderController extends Controller
{
    use HasDefaultActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'slider::sliders.slider';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'slider::admin.sliders';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveSliderRequest::class;
}
