<?php

namespace Modules\Favorite\Http\Controllers;

use Illuminate\Routing\Controller;

class FavoriteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if ($this->alreadyInFavorite()) {
            return back();
        }

        auth()->user()->favoriteLists()->attach(request('ebook_id'));

        return back()->withSuccess(clean(trans('favorite::messages.added')));
    }

    private function alreadyInFavorite()
    {
        $favorite = auth()->user()->favoriteLists()->pluck('ebook_id');

        return $favorite->contains(request('ebook_id'));
    }
}
