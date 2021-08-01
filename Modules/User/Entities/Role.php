<?php

namespace Modules\User\Entities;

use Cartalyst\Sentinel\Roles\EloquentRole;
use Modules\User\Repositories\Permission;
use Modules\Admin\Ui\AdminTable;
use Modules\Base\Traits\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends EloquentRole
{
    use Sluggable;
        
    protected $fillable = [
        'name',
        'slug',
        'permissions',
    ];
    
    protected $slugAttribute = 'name';
    
    /**
     * The Users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id')->withTimestamps();
    }
    
    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }

    /**
     * Set role's permissions.
     *
     * @param array $permissions
     * @return void
     */
    public function setPermissionsAttribute(array $permissions)
    {
        $this->attributes['permissions'] = Permission::prepare($permissions);
    }

    /**
     * Get table data for the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table()
    {
        return new AdminTable($this->newQuery());
    }
    
    /**
     * Get a list of all roles.
     *
     * @return array
     */
    public static function list()
    {
        return static::get()->pluck('name', 'id');
    }
}
