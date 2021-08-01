<?php

namespace Modules\Menu\Entities;

use Modules\Base\Eloquent\Model;
use Modules\Base\Eloquent\Translatable;
use Modules\Admin\Ui\AdminTable;

class Menu extends Model
{
    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['is_active'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['name'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addActiveGlobalScope();
    }

    public static function for($menuId)
    {
        return static::findOrNew($menuId)
            ->menuItems()
            ->with(['category', 'page'])
            ->get()
            ->noCleaning()
            ->nest();
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class)->orderByRaw('-position DESC');
    }
    
    public static function findById($id)
    {
        return static::where('id', $id)->withoutGlobalScope('active')->first();
    }
    
    /**
     * Get table data for the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table()
    {
        return new AdminTable($this->newQuery()->withoutGlobalScope('active'));
    }
}
