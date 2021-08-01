<?php

namespace Modules\Review\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Ebook\Entities\Ebook;
use Modules\Review\Http\Requests\StoreReviewRequest;

class EbookReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param int $ebookId
     * @param \Modules\Review\Http\Requests\StoreReviewRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store($ebookId, StoreReviewRequest $request)
    {
        if (! setting('reviews_enabled')) {
            return back();
        }

        Ebook::findOrFail($ebookId)
            ->reviews()
            ->create([
                'reviewer_id' => auth()->id(),
                'rating' => $request->rating,
                'reviewer_name' => $request->reviewer_name,
                'comment' => $request->comment,
                'is_approved' => setting('auto_approve_reviews', 0),
            ]);

        return back()->withSuccess($this->message());
    }

    /**
     * Returns the success message.
     *
     * @return string
     */
    private function message()
    {
        if (setting('auto_approve_reviews')) {
            return clean(trans('review::messages.thank_you'));
        }

        return clean(trans('review::messages.submitted_for_approval'));
    }
}
