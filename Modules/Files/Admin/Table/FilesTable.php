<?php

namespace Modules\Files\Admin\Table;

use Modules\Admin\Ui\AdminTable;
use Illuminate\Support\Facades\Crypt;

class FilesTable extends AdminTable
{
    /**
     * Raw columns that will not be escaped.
     *
     * @var array
     */
    protected $rawColumns = ['action','size'];

    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->editColumn('thumbnail', function ($file) {
                return view('admin::include.table.thumbnail', compact('file'));
            })
            ->editColumn('size', function ($file) {
                return display_filesize($file->size);
            })
            ->editColumn('action', function ($file) {
                $download_key=id_encode($file->id);
                return view('files::admin.files.include.action', compact('file','download_key'));
            });
            
    }
}
