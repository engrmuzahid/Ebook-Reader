<?php

namespace Modules\Base\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;

trait Sluggable
{
    /**
     * Hook into the Eloquent model events to create or update the slug as required.
     *
     * @return void
     */
    public static function bootSluggable()
    {
        static::creating(function ($entity) {
            $entity->makeSlug();
        });
    }

    /**
     * Set the slug attribute.
     *
     * @param string $value
     * @return void
     */
    public function makeSlug($value = null)
    {
        if (is_null($value)) {
            $value = $this->getAttribute($this->slugAttribute);
        }

        $this->attributes['slug'] = $this->buildSlug($value);
    }

    /**
     * build slug by the given value.
     *
     * @param string $value
     * @return string
     */
    private function buildSlug($value)
    {
        $slug = slugify($value);

        $query =$this->where('slug', $slug)
                    ->withoutGlobalScope('active');

        if (array_has(class_uses($this), SoftDeletes::class)) {
            $query->withTrashed();
        }

        if ($query->exists()) {
            $slug .= '-' . str_random(8);
        }

        return $slug;
    }
}
