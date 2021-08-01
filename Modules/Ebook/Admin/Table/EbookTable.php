<?php

namespace Modules\Ebook\Admin\Table;

use Modules\Admin\Ui\AdminTable;

class EbookTable extends AdminTable
{
    /**
     * Raw columns that will not be escaped.
     *
     * @var array
     */
    protected $rawColumns = ['bookcover','password'];

    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->editColumn('bookcover', function ($ebook) {
                $path = optional($ebook->book_cover)->path;

                return view('ebook::admin.ebooks.include.table.bookcover', compact('path'));
            })
            ->editColumn('password', function ($ebook) {
                if($ebook->password!=''){return '<i class="fas fa-lock"></i>';}else{return '-';}
            })
            ->editColumn('is_featured', function ($ebook) {
                if($ebook->is_featured==1){return 'Yes';}else{return 'No';}
            })
            ->editColumn('is_private', function ($ebook) {
                if($ebook->is_private==1){return 'Yes';}else{return 'No';}
            });
    }
}
