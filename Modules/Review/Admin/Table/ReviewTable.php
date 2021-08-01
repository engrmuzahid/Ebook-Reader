<?php

namespace Modules\Review\Admin\Table;

use Modules\Admin\Ui\AdminTable;

class ReviewTable extends AdminTable
{
    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->editColumn('ebook', function ($review) {
                return $review->ebook->title;
            })
            ->editColumn('status', function ($review) {
                return $review->is_approved
                    ? '<button type="button" class="btn btn-icon btn-success btn-xs"><i class="fas fa-check"></i></button>'
                    : '<button type="button" class="btn btn-icon btn-danger btn-xs"><i class="fas fa-times"></i></button>';
            });
    }
}
