<?php

namespace Modules\Base\Eloquent;

use Astrotomic\Translatable\Translatable as AstrotomicTranslatable;

trait Translatable
{
    use AstrotomicTranslatable;

    public function save(array $options = [])
    {
        if (parent::save($options)) {
            return $this->saveTranslations();
        }

        return false;
    }

    public function scopeWhereTranslationIn($query, $key, array $values, $locale = null)
    {
        return $query->whereHas('translations', 
                    function ($query) use ($key, $values, $locale) {
                        $query->whereIn($key, $values)
                            ->when(! is_null($locale), 
                                function ($query) use ($locale) {
                                    $query->where('locale', $locale);
                                });
                    });
    }
}
