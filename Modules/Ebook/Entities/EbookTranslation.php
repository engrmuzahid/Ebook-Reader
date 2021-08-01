<?php

namespace Modules\Ebook\Entities;

use Modules\Base\Eloquent\TranslationModel;

class EbookTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'short_description', 'publisher'];
}
