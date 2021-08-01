<?php

namespace Modules\Review\Admin\Tabs;

use Modules\Admin\Ui\CiTab;
use Modules\Admin\Ui\CiTabs;

class EbookTabsExtender
{
    public function extend(CiTabs $tabs)
    {
        $tabs->group('ebook_information')
            ->add($this->reviews());
    }

    private function reviews()
    {
        if (! request()->routeIs('admin.ebooks.edit')) {
            return;
        }

        return tap(new CiTab('reviews', clean(trans('review::reviews.tabs.ebooks.reviews'))), function (CiTab $tab) {
            $tab->weight(50);
            $tab->view('review::admin.ebooks.tabs.reviews');
        });
    }
}
