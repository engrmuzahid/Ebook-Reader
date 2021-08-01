<?php

namespace Themes\Cynoebook\Http\ViewComposers;

use Illuminate\Support\Facades\DB;
use Modules\Ebook\Entities\Ebook;
use Modules\Category\Entities\Category;


class EbooksFilterComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        $view->with([
            'categories' => $this->categories(),
        ]);
    }

    private function categories()
    {
        return Category::tree();
    }

}
