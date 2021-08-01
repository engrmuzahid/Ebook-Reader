<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Routing\Controller;

class AccountFavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ebooks = auth()->user()
            ->favoriteLists()
            ->with('files')
            ->paginate(10);
        return view('public.account.favorite.index', compact('ebooks'));
    }

    public function destroy($ebookId)
    {
        auth()->user()->favoriteLists()->detach($ebookId);

        return back()->withSuccess(clean(trans('account::messages.ebook_removed_from_favorite')));
    }
}
