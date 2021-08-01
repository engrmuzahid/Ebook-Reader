<?php

namespace Modules\Review\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Admin\Traits\HasDefaultActions;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\Review\Entities\Review;
use Modules\Review\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    use HasDefaultActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'review::reviews.review';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'review::admin.reviews';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = UpdateReviewRequest::class;

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::withoutGlobalScope('approved')->findOrFail($id);

        $tabs = TabManager::get('reviews');

        return view('review::admin.reviews.edit', compact('review', 'tabs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $review = Review::withoutGlobalScope('approved')->findOrFail($id);

        $review->update(request()->all());

        return back()->withSuccess(clean(trans('admin::messages.saved_message', ['resource' => trans('review::reviews.review')])));
    }
}
