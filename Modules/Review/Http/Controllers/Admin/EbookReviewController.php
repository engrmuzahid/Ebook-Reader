<?php

namespace Modules\Review\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Review\Entities\Review;

class EbookReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('table')) {
            $review = new Review();
            return $review->table($request);
        }

        return view('review::admin.reviews.index');
    }
}
