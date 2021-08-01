<?php

namespace Modules\Ebook\Entities;

use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Eloquent\Model;
use Modules\Base\Search\Searchable;
use Modules\User\Entities\User;
use Modules\Ebook\Admin\Table\ReportedEbookTable;


class ReportedEbook extends Model
{
    use Searchable,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ebook_id',
        'user_id',
        'reason',
    ];
    
    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function ebook()
    {
        return $this->belongsTo(Ebook::class)->withTrashed();
    }
    
    public function scopeForCard($query)
    {
        $query->with(['user','ebook'])
                ->addSelect(['id', 'ebook_id','user_id','reason','created_at']);
    }
    
    /**
     * Get table data for the resource
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function table($request)
    {
       
        $query = $this->newQuery()->with(['user','ebook'])
            ->addSelect(['id', 'ebook_id','user_id','reason','created_at'])
            ->when($request->has('except'), function ($query) use ($request) {
                $query->whereNotIn('id', explode(',', $request->except));
            });
            
        return new ReportedEbookTable($query);
    }
    
    
}
