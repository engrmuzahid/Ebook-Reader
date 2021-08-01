<?php

namespace Modules\Base\Eloquent;

use Illuminate\Database\Eloquent\Model;

abstract class TranslationModel extends Model
{
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('locale', function ($query) {
            $query->whereIn('locale', [locale(), config('app.fallback_locale')]);
        });
    }
}
