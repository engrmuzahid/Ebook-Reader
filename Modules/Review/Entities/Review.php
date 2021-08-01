<?php

namespace Modules\Review\Entities;

use Illuminate\Http\Request;
use Modules\Base\Eloquent\Model;
use Modules\User\Entities\User;
use Modules\Ebook\Entities\Ebook;
use Modules\Review\Admin\Table\ReviewTable;

class Review extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_approved' => 'boolean',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('approved', function ($query) {
            $query->where('is_approved', true);
        });
    }
    
    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }

    public function ebook()
    {
        return $this->belongsTo(Ebook::class)->withTrashed();
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    /**
     * Get table data for the resource
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function table(Request $request)
    {
        $query = static::withoutGlobalScope('approved')
            ->with(['ebook' => function ($query) {
                $query->withoutGlobalScope('active');
            }])
            ->when($request->ebookId, function ($query) use ($request) {
                return $query->where('ebook_id', $request->ebookId);
            });

        return new ReviewTable($query);
    }
}
