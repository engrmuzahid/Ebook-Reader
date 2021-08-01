<?php

namespace Modules\Slider\Entities;

use Modules\Base\Eloquent\Model;
use Modules\Base\Eloquent\Translatable;
use Modules\Files\Entities\Files;

class SliderSlide extends Model
{
    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations', 'files'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['options', 'call_to_action_url', 'open_in_new_window', 'position'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array',
        'open_in_new_window' => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'files_id',
        'caption_1',
        'caption_2',
        'caption_3',
        'call_to_action_text',
    ];

    public function files()
    {
        return $this->belongsTo(Files::class)->withDefault();
    }
}
