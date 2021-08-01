<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Routing\Controller;

class AccountReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = auth()->user()
            ->reviews()
            ->with('ebook.files')
            ->whereHas('ebook')
            ->paginate(15);

        return view('public.account.reviews.index', compact('reviews'));
    }
}
