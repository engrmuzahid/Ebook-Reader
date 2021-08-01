<?php

namespace Modules\Slider\Entities;

use Modules\Base\Eloquent\TranslationModel;

class SliderSlideTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'files_id',
        'caption_1',
        'caption_2',
        'caption_3',
        'call_to_action_text',
    ];
}
