<?php

namespace Modules\User\Entities;

use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Users\EloquentUser;
use Laravelista\Comments\Commenter;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Modules\User\Admin\Table\UserTable;
use Modules\User\Repositories\Permission;
use Modules\Files\Entities\Files;
use Modules\Files\Eloquent\HasMedia;
use Modules\Ebook\Entities\Ebook;
use Modules\Review\Entities\Review;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends EloquentUser implements AuthenticatableContract
{
    use Authenticatable,HasMedia,Commenter;

    protected $fillable = [
        'first_name', 'last_name', 'username','email', 'password', 'permissions', 'about', 'facebook', 'twitter', 'google', 'instagram', 'linkedin', 'youtube'
    ];
    
    protected $dates = ['last_login'];
    
    protected $appends = ['full_name'];
    
    protected static $logName = 'users';
    
   
    public static function registered($email)
    {
        return static::where('email', $email)->exists();
    }

    public static function findByEmail($email)
    {
        return static::where('email', $email)->first();
    }
    
    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }
    
    /**
     * Login the user.
     *
     * @return $this|bool
     */
    public function login()
    {
        return auth()->login($this);
    }

    /**
     * Determine if the user is a User.
     *
     * @return bool
     */
    public function isUser()
    {
        if ($this->hasRoleName('admin')) {
            return false;
        }

        return $this->hasRoleId(setting('user_role'));
    }
    
    public function isAdmin()
    {
        if ($this->hasRoleName('admin')) {
            return true;
        }

        return false;
    }

    /**
     * Checks if a user belongs to the given Role ID.
     *
     * @param int $roleId
     * @return bool
     */
    public function hasRoleId($roleId)
    {
        return $this->roles()->whereId($roleId)->count() !== 0;
    }

    /**
     * Checks if a user belongs to the given Role Slug.
     *
     * @param string $slug
     * @return bool
     */
    public function hasRoleSlug($slug)
    {
        return $this->roles()->whereSlug($slug)->count() !== 0;
    }

    /**
     * Checks if a user belongs to the given Role Name.
     *
     * @param string $name
     * @return bool
     */
    public function hasRoleName($name)
    {
        return $this->roles()->whereName($name)->count() >= 1;
    }

    /**
     * Check if the current user is activated.
     *
     * @return bool
     */
    public function isActivated()
    {
        return Activation::completed($this);
    }

    /**
     * Get the roles of the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany 
    {
        return $this->belongsToMany(Role::class, 'user_roles')->withTimestamps();
    }
    
    /**
     * Get the reviews of the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }
    
    /**
     * Get the Favorite of the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoriteLists()
    {
        return $this->belongsToMany(Ebook::class, 'favorite_lists')->withTimestamps();
    }
    
    public function scopeWithAvatar($query)
    {
        $query->with(['files' => function ($q) {
            $q->wherePivot('zone', 'avatar');
        }]);
    }
    
    public function getAvatarAttribute()
    {
        return $this->files->where('pivot.zone', 'avatar')->first() ?: new Files;
    }
    
    public function ebooks()
    {
        return $this->hasMany(Ebook::class);
    }
    
    /**
     * Get the full name of the user.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Set user's permissions.
     *
     * @param array $permissions
     * @return void
     */
    public function setPermissionsAttribute(array $permissions)
    {
        $this->attributes['permissions'] = Permission::prepare($permissions);
    }

    /**
     * Determine if the user has access to the given permissions.
     *
     * @param array|string $permissions
     * @return bool
     */
    public function hasAccess($permission)
    {
        $permission = is_array($permission) ? $permission : func_get_args();
        $permissions = $this->getPermissionsInstance();
        return $permissions->hasAccess($permission);
    }

    /**
     * Determine if the user has access to the any given permissions
     *
     * @param array|string $permissions
     * @return bool
     */
    public function hasAnyAccess($permission)
    {
        $permission = is_array($permission) ? $permission : func_get_args();
        $permissions = $this->getPermissionsInstance();

        return $permissions->hasAnyAccess($permission);
    }
    
    /**
     * Get table data for the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table()
    {
        return new UserTable($this->newQuery());
    }
    
    public static function totalUsers()
    {
        return Role::findOrNew(setting('user_role'))->users()->count();
    }
    
    
    public static function list()
    {
        return static::select('id','first_name','last_name')
            ->get()
            ->mapWithKeys(function ($user) {
                return [$user->id => $user->FullName];
            });
    }
    
}
