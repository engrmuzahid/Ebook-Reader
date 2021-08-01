<?php

namespace Modules\Menu\Entities;

use TypiCMS\NestableTrait;
use Modules\Page\Entities\Page;
use Modules\Base\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Base\Eloquent\Translatable;
use Illuminate\Support\Arr;

class MenuItem extends Model
{
    use Translatable, NestableTrait;

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
    protected $fillable = [
        'menu_id',
        'category_id',
        'page_id',
        'parent_id',
        'type',
        'url',
        'target',
        'position',
        'is_root',
        'is_fluid',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_root' => 'boolean',
        'is_fluid' => 'boolean',
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

        static::addGlobalScope('not_root', function ($query) {
            $query->where('is_root', false);
        });

        static::addActiveGlobalScope();
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Set the menu item's page id.
     *
     * @param int $pageId
     * @return void
     */
    public function setPageIdAttribute($pageId)
    {
        $this->attributes['page_id'] = $pageId;
    }

    /**
     * Set the menu item's parent id.
     *
     * @param int $parentId
     * @return void
     */
    public function setParentIdAttribute($parentId)
    {
        $this->attributes['parent_id'] = $parentId;
    }

    /**
     * Determine if the menu item has any children.
     *
     * @return bool
     */
    public function hasChildren()
    {
        return $this->items->isNotEmpty();
    }

    /**
     * Determine if the menu item type is category.
     *
     * @return bool
     */
    public function isCategoryType()
    {
        return $this->type === 'category';
    }

    /**
     * Determine if the menu item type is page.
     *
     * @return bool
     */
    public function isPageType()
    {
        return $this->type === 'page';
    }

    /**
     * Determine if the menu item type is url.
     *
     * @return bool
     */
    public function isUrlType()
    {
        return $this->type === 'url';
    }

    /**
     * Returns the public url for the menu item.
     *
     * @return string
     */
    public function url()
    {
        if ($this->isCategoryType()) {
            return optional($this->category)->url();
        }

        if ($this->isPageType()) {
            return optional($this->page)->url();
        }

        if ($this->getAttributeFromArray('url') === '#') {
            return '#';
        }
        
        $urlData=parse_url($this->getAttributeFromArray('url'));
        if(Arr::exists($urlData, 'scheme')){
            return $this->getAttributeFromArray('url');
        }
        
        return localized_url(locale(), $this->getAttributeFromArray('url'));
    }

    /**
     * Get the root menu item for the given menu id.
     *
     * @param int $menuId
     * @return $this
     */
    public static function root($menuId)
    {
        return static::withoutGlobalScope('not_root')
            ->where('menu_id', $menuId)
            ->firstOrFail();
    }

    /**
     * Get the parents of the given menuId.
     *
     * @param int $menuId
     * @param int $menuItemId
     * @return array
     */
    public static function parents($menuId, $menuItemId)
    {
        return static::withoutGlobalScope('active')
            ->where('id', '!=', $menuItemId)
            ->where('menu_id', $menuId)
            ->get()
            ->noCleaning()
            ->nest()
            ->setIndent('¦–– ')
            ->listsFlattened('name');
    }
}
