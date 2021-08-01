<?php

namespace Modules\Page\Admin\Tabs;

use Modules\Admin\Ui\CiTab;
use Modules\Admin\Ui\CiTabs;

class PageTabs extends CiTabs
{
    public function make()
    {
        $this->group('page_information', clean(trans('page::pages.tabs.group.page_information')))
            ->active()
            ->add($this->general())
            ->add($this->seo());
    }

    private function general()
    {
        return tap(new CiTab('general', clean(trans('page::pages.tabs.general'))), function (CiTab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['title', 'body', 'is_active', 'slug']);
            $tab->view('page::admin.pages.tabs.general');
        });
    }

    private function seo()
    {
        return tap(new CiTab('seo', clean(trans('page::pages.tabs.seo'))), function (CiTab $tab) {
            $tab->weight(10);
            $tab->view('page::admin.pages.tabs.seo');
        });
    }
}
