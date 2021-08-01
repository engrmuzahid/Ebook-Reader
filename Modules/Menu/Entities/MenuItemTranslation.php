<?php

namespace Modules\Menu\Entities;

use Modules\Base\Eloquent\TranslationModel;

class MenuItemTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
