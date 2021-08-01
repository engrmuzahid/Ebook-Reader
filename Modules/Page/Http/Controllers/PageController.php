<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Page\Entities\Page;
use Modules\Files\Entities\Files;

class PageController extends Controller
{
    /**
     * Display page for the slug.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $logo = Files::findOrNew(setting('cynoebook_header_logo'))->path;
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('public.pages.show', compact('page', 'logo'));
    }
}
