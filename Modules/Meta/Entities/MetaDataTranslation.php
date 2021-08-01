<?php

namespace Modules\Meta\Entities;

use Modules\Base\Eloquent\TranslationModel;

class MetaDataTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['meta_title', 'meta_keywords', 'meta_description'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta_keywords' => 'array',
    ];
}
