<?php

namespace Modules\Ebook\Admin\Table;

use Modules\Admin\Ui\AdminTable;

class ReportedEbookTable extends AdminTable
{
    /**
     * Raw columns that will not be escaped.
     *
     * @var array
     */
   protected $rawColumns = ['action'];

    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        
        return $this->newTable()
            ->editColumn('action', function ($reportedEbook) {
                return '<a class="btn btn-primary btn-xs" target="_blank" href="'.route('admin.ebooks.edit',$reportedEbook->ebook_id).'"> '.clean(trans('ebook::reportedebooks.table.edit_ebook')).'</a>';
            });
    }
}
