<?php

namespace Modules\Base\Eloquent;

use Illuminate\Database\Eloquent\Model as DatabaseEloquentModel;
use Illuminate\Support\Facades\Cache;

abstract class Model extends DatabaseEloquentModel
{
    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($model) {
            Cache::tags($model->getTable())->flush();
        });
        
        static::saved(function ($model) {
            Cache::tags($model->getTable())->flush();
        });

        
    }

    public static function addActiveGlobalScope()
    {
        static::addGlobalScope('active', function ($builder) {
            $builder->where('is_active', true);
        });
    }
}
