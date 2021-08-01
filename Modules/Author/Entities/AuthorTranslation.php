<?php

namespace Modules\Author\Entities;

use Modules\Base\Eloquent\TranslationModel;

class AuthorTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description'];
}
