<?php

namespace Modules\Category\Entities;

use Modules\Base\Eloquent\TranslationModel;

class CategoryTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
