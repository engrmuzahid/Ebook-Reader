<?php

namespace Modules\Slider\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Admin\Traits\HasDefaultActions;
use Modules\Slider\Entities\SliderOption;
use Modules\Slider\Http\Requests\SaveSliderOptionRequest;

class SliderOptionController extends Controller
{
    use HasDefaultActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = SliderOption::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'slider::slider_options.slider_option';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'slider::admin.slider_options';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveSliderOptionRequest::class;
}
