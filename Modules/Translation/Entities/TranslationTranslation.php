<?php

namespace Modules\Translation\Entities;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class TranslationTranslation extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['locale', 'value'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($translationTranslation) {
            $translationTranslation->clearCache();
        });
    }

    /**
     * Clear translations cache.
     *
     * @return bool
     */
    public static function clearCache()
    {
        Cache::tags('translations')->flush();
    }
}
