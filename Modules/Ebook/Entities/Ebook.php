<?php

namespace Modules\Ebook\Entities;

use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravelista\Comments\Commentable;
use Modules\Base\Eloquent\Model;
use Modules\Base\Search\Searchable;
use Modules\Base\Traits\Sluggable;
use Modules\Base\Eloquent\Translatable;
use Modules\Files\Eloquent\HasMedia;
use Modules\Files\Entities\Files;
use Modules\Meta\Eloquent\HasMetaData;
use Modules\Category\Entities\Category;
use Modules\Author\Entities\Author;
use Modules\User\Entities\User;
use Modules\Review\Entities\Review;
use Modules\Ebook\Admin\Table\EbookTable;
use Modules\Ebook\Entities\ReportedEbook;

class Ebook extends Model
{
    use Translatable,
        Searchable,
        Sluggable,
        HasMedia,
        HasMetaData,
        SoftDeletes,
        Commentable;

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
        'user_id',
        'slug',
        'file_type',
        'file_url',
        'embed_code',
        'isbn',
        'price',
        'buy_url',
        'publication_year',
        'password',
        'is_featured',
        'is_private',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'is_private' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['title', 'description', 'short_description', 'publisher'];

    /**
     * The attribute that will be slugged.
     *
     * @var string
     */
    protected $slugAttribute = 'title';
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($ebook) {
            if (! empty(request()->all())) {
                $ebook->saveRelations(request()->all());
            }
        });

        static::addActiveGlobalScope();
    }

    public static function list($ids = [])
    {
        return static::withTitle()
            ->whereIn('id', $ids)
            ->select('id')
            ->get()
            ->mapWithKeys(function ($ebook) {
                return [$ebook->id => $ebook->title];
            });
    }
    
    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }
    
    public function scopeForCard($query)
    {
        $query->WithTitle()->isPrivate()
            ->withBookFiles()->with('user')->with('authors')->select('user_id')
            ->addSelect([
                'ebooks.id',
                'slug',
                'file_type',
                'file_url',
                'embed_code',
                'isbn',
                'price',
                'buy_url',
                'publication_year',
                'viewed',
                'password',
                'is_featured',
                'is_private',
                'is_active',
                'ebooks.created_at',
             ]);
    }
    
    public function scopeIsPrivate($query)
    {
        if (!auth()->user()) {
            $query->where('is_private',0);
        }
        /* if (auth()->user()) {
            $query->where('is_private',0)->orWhere('user_id',auth()->user()->id);
        }else{
           $query->where('is_private',0);
        } */
    }
    public function scopeWithTitle($query)
    {
        $query->with('translations:id,ebook_id,locale,title,description,short_description,publisher');
    }
    
    public function scopeWithBookCover($query)
    {
        $query->with(['files' => function ($q) {
            $q->wherePivot('zone', 'book_cover');
        }]);
    }
    
    public function scopeWithBookPdf($query)
    {
        $query->with(['files' => function ($q) {
            $q->wherePivot('zone', 'book_file');
        }]);
    }
    
    public function scopeWithBookFiles($query)
    {
        $query->with(['files' => function ($q) {
            $q->wherePivotIn('zone', [ 'book_cover','book_file']);
        }]);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'ebook_categories');
    }
    
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'ebook_authors');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    
    public function isFavorite()
    {
        if (auth()->user()) {
            $favorite = auth()->user()->favoriteLists()->pluck('ebook_id');
            return $favorite->contains($this->id);
        }else{
            return 0;
        }
    }
    
    public function filter($filter)
    {
        return $filter->apply($this);
    }

    /**
     * Get the ebook's Book Cover.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getBookCoverAttribute()
    {
        return $this->files->where('pivot.zone', 'book_cover')->first() ?: new Files;
    }

    /**
     * Get ebook's Book PDF.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getBookFileAttribute()
    {
        return $this->files->where('pivot.zone', 'book_file')->first() ?: new Files;
            
    }
    
    public function getAudioBookFilesAttribute()
    {
        return $this->files
            ->where('pivot.zone', 'audio_book_files')
            ->sortBy('pivot.id');
    }
    
    public function getAuthors()
    {
        if ($this->authors()->exists()) {
            return $this->authors->pluck('name')->implode(', ');
        }
        return '';
    }
    
    
    public function isFeatured()
    {
        if ($this->is_featured) {
            return true;
        }
        return false;
    }
    
    public function isPrivateEbook()
    {
        if ($this->is_private) {
            return true;
        }
        return false;
    }
    
    public function isPasswordProtected()
    {
        if ($this->password!='') {
            return true;
        }
        return false;
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function reportedEbook()
    {
        return $this->hasMany(ReportedEbook::class);
    }
    
    public function avgRating()
    {
        return ceil($this->reviews->avg->rating * 2) / 2;
    }
    
    public function implodeCategories()
    {
        return $this->categories->implode('name', ', ');
    }
    
    public function totalReviewsForRating($rating)
    {
        return $this->reviews->where('rating', $rating)->count();
    }

    public function percentageReviewsForStar($rating)
    {
        $totalReviews = $this->reviews->count();

        if ($totalReviews === 0) {
            return 0;
        }

        $reviewsCount = $this->totalReviewsForRating($rating);

        return round($reviewsCount / $totalReviews * 100);
    }
    
    /**
     * Get table data for the resource
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function table($request)
    {
        $query = $this->newQuery()
            ->withoutGlobalScope('active')
            ->WithTitle()
            ->withBookCover()
            ->with('user')
            /* ->addSelect(['id', 'is_private','is_featured','password','is_active', 'created_at','viewed','user.full_name']) */
            ->when($request->has('except'), function ($query) use ($request) {
                $query->whereNotIn('id', explode(',', $request->except));
            });
            
        return new EbookTable($query);
    }
    
    /**
     * Save associated relations for the ebook.
     *
     * @param array $attributes
     * @return void
     */
    public function saveRelations($attributes = [])
    {
        $this->categories()->sync(array_get($attributes, 'categories', []));
        
        $authors=Author::syncNewAuthor(array_get($attributes, 'authors', []));
        $this->authors()->sync($authors);
    }

    /**
     * Get the indexable data array for the ebook.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        // MySQL Full-Text search handles indexing automatically.
        if (config('scout.driver') === 'mysql') {
            return [];
        }

        $translations = $this->translations()
            ->withoutGlobalScope('locale')
            ->get(['title', 'description', 'short_description', 'publisher']);

        return ['id' => $this->id, 'translations' => $translations];
    }

    public function searchTable()
    {
        return 'ebook_translations';
    }

    public function searchKey()
    {
        return 'ebook_id';
    }

    public function searchColumns()
    {
        return ['title'];
    }
    
    public static function findBySlug($slug)
    {
        return static::with([
            'files'
        ])->isPrivate()->where('slug', $slug)->firstOrFail();
    }
}
