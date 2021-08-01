<?php

namespace Modules\Review\Admin\Tabs;

use Modules\Admin\Ui\CiTab;
use Modules\Admin\Ui\CiTabs;

class ReviewTabs extends CiTabs
{
    /**
     * Make new tabs with groups.
     *
     * @return void
     */
    public function make()
    {
        $this->group('review_information', clean(trans('review::reviews.tabs.group.review_information')))
            ->active()
            ->add($this->general());
    }

    private function general()
    {
        return tap(new CiTab('review', clean(trans('review::reviews.tabs.general'))), function (CiTab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['rating', 'reviewer_name', 'comment', 'is_approved']);
            $tab->view('review::admin.reviews.tabs.general');
        });
    }
}
