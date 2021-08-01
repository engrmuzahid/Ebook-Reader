<?php

namespace Modules\Category\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Services\CategoryTreeUpdater;
use Modules\Category\Http\Responses\CategoryTreeResponse;

class CategoryTreeController extends Controller
{
    /**
     * Display category tree in json.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withoutGlobalScope('active')
            ->orderByRaw('-position DESC')
            ->get();

        return new CategoryTreeResponse($categories);
    }

    /**
     * Update category tree in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        CategoryTreeUpdater::update(request('category_tree'));

        return clean(trans('category::messages.category_order_saved'));
    }
}
