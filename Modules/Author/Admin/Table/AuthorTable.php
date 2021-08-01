<?php

namespace Modules\Author\Admin\Table;

use Modules\Admin\Ui\AdminTable;

class AuthorTable extends AdminTable
{
    /**
     * Raw columns that will not be escaped.
     *
     * @var array
     */
    protected $rawColumns = ['image','is_verified'];

    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->editColumn('image', function ($author) {
                $path = optional($author->author_image)->path;

                return view('author::admin.authors.include.table.author-image', compact('path'));
            })
            ->editColumn('is_verified', function ($user) {
                return $user->is_verified
                    ? '<button type="button" class="btn btn-icon btn-success btn-xs"><i class="fas fa-check"></i></button>'
                    : '<button type="button" class="btn btn-icon btn-danger btn-xs"><i class="fas fa-times"></i></button>';
            });
    }
}
