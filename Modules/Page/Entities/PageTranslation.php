<?php

namespace Modules\Page\Entities;

use Modules\Base\Eloquent\TranslationModel;

class PageTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'body'];
}
