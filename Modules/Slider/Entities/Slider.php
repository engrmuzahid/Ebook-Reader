<?php

namespace Modules\Slider\Entities;

use Modules\Admin\Ui\AdminTable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Modules\Base\Eloquent\Translatable;

class Slider extends Model
{
    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations', 'slides'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['autoplay', 'autoplay_speed', 'arrows', 'fade'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($slider) {
            $slider->saveSlides(request('slides', []));
            $slider->clearCache();
        });
    }

    public function clearCache()
    {
        Cache::tags(["sliders.{$this->id}"])->flush();
    }

    public static function findWithSlides($id)
    {
        if (is_null($id)) {
            return;
        }

        return Cache::tags(["sliders.{$id}"])
            ->rememberForever("sliders.{$id}:" . locale(), function () use ($id) {
                return static::with('slides')->find($id);
            });
    }

    public function slides()
    {
        return $this->hasMany(SliderSlide::class)->orderBy('position');
    }
    
    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }
    
    public static function findByIds($ids)
    {
        return static::whereIn('id', $ids)->get();
    }
    
    public function getAutoplaySpeedAttribute($autoplaySpeed)
    {
        return $autoplaySpeed ?: 3000;
    }

    public function table()
    {
        return new AdminTable($this->newQuery());
    }

    /**
     * Save slides for the slider.
     *
     * @param array $slides
     * @return void
     */
    public function saveSlides($slides)
    {
        $ids = $this->getDeleteCandidates($slides);

        if ($ids->isNotEmpty()) {
            $this->slides()->whereIn('id', $ids)->delete();
        }

        foreach (array_reset_index($slides) as $index => $slide) {
            $this->slides()->updateOrCreate(
                ['id' => $slide['id']],
                $slide + ['position' => $index]
            );
        }
    }

    private function getDeleteCandidates($slides = [])
    {
        return $this->slides()
            ->pluck('id')
            ->diff(array_pluck($slides, 'id'));
    }
}
