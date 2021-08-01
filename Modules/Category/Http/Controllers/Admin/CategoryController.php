<?php

namespace Modules\Category\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Admin\Traits\HasDefaultActions;
use Modules\Category\Http\Requests\SaveCategoryRequest;

class CategoryController extends Controller
{
    use HasDefaultActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'category::categories.category';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'category::admin.categories';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveCategoryRequest::class;

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::withoutGlobalScope('active')->find($id);
    }

    /**
     * Destroy resources by given ids.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::withoutGlobalScope('active')
            ->findOrFail($id);
           
        activity('categories')
            ->performedOn($category)
            ->causedBy(auth()->user())
            ->withProperties(['subject' => $category,'causer'=>auth()->user()])
            ->log('deleted');
        $category->delete();
        Category::where('parent_id', $id)->delete();
        return back()->withSuccess(clean(trans('admin::messages.deleted_message', ['resource' => trans('category::categories.category')])));
    }
}
