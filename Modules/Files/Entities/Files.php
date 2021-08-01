<?php

namespace Modules\Files\Entities;

use Illuminate\Support\Facades\Storage;
use Modules\Base\Eloquent\Model;
use Modules\Files\Helpers\FilesIcon;
use Modules\Files\Admin\Table\FilesTable;
use Modules\User\Entities\User;

class Files extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($file) {
            Storage::disk($file->disk)->delete($file->getOriginal('path'));
        });
    }
    
    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }
    
    public static function findByIds($ids)
    {
        return static::whereIn('id', $ids)->get();
    }
    
    public function uploader()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    
    public function table($request)
    {
        $query = $this->newQuery()
            ->when(! is_null($request->type) && $request->type !== 'null' && $request->type !== '', function ($query) use ($request) {
                $query->where('mime', 'LIKE', "{$request->type}/%");
            })->when(! is_null($request->extension) && $request->extension !== 'null' && $request->extension !== '', function ($query) use ($request) {
                $extension=explode(',',$request->extension);
                $query->whereIn('extension', $extension);
            });
        
        return new FilesTable($query);
    }
    
    public function icon()
    {
        return FilesIcon::getIcon($this->mime);
    }
    
    public function getPathAttribute($path)
    {
        if (! is_null($path)) {
            return Storage::disk($this->disk)->url($path);
        }
    }

    public function isImage()
    {
        return strtok($this->mime, '/') === 'image';
    }
    
    public function isVideo()
    {
        return strtok($this->mime, '/') === 'video';
    }
    
}
