<?php

namespace Modules\Author\Entities;

use Illuminate\Support\Facades\Cache;
use Modules\Base\Eloquent\Model;
use Modules\Base\Traits\Sluggable;
use Modules\Base\Eloquent\Translatable;
use Modules\Author\Admin\Table\AuthorTable;
use Modules\Files\Eloquent\HasMedia;
use Modules\Files\Entities\Files;
use Modules\User\Entities\User;
use Modules\Ebook\Entities\Ebook;

class Author extends Model
{
    use Translatable, Sluggable, HasMedia;

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
    protected $fillable = ['user_id','slug','is_active','is_verified'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_verified' => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['name','description'];

    /**
     * The attribute that will be slugged.
     *
     * @var string
     */
    protected $slugAttribute = 'name';
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addActiveGlobalScope();
        static::saving(function ($model) {
            if(auth()->user()){
                $model->user_id = auth()->user()->id;
            }
        });
    }
    
    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }
    
    public static function syncNewAuthor($newAuthors)
    {
        $authorID=[];
        
        foreach($newAuthors as $author) {
            
            if (substr($author, 0, 4) == 'new:')
            {
                $na = new Author;
                $na->name = substr($author, 4);
                $na->is_active = 1;
                $na->is_verified = 0;
                $na->save();
                $authorID[]=$na->id;
                continue;
            }
            $authorID[]=$author;
            
        }
        return $authorID;
    }
    
    public function scopeWithAuthorImage($query)
    {
        $query->with(['files' => function ($q) {
            $q->wherePivot('zone', 'author_image');
        }]);
    }
    
    public function getAuthorImageAttribute()
    {
        return $this->files->where('pivot.zone', 'author_image')->last() ?: new Files;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    
    public function ebooks()
    {
        return $this->belongsToMany(Ebook::class, 'ebook_authors');
    }
    
    public function table($request)
    {
        $query = $this->newQuery()->with('user')
            ->withoutGlobalScope('active');
            
        return new AuthorTable($query);
    }
    public function scopeWithName($query)
    {
        $query->with('translations:id,author_id,locale,name,description');
    }
    public static function list()
    {
        return static::withName()->select('id')
            ->get()
            ->mapWithKeys(function ($auhor) {
                return [$auhor->id => $auhor->name];
            });
    }
}

    
