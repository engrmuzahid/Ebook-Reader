<?php

namespace Modules\Author\Admin\Tabs;

use Modules\Admin\Ui\CiTab;
use Modules\Admin\Ui\CiTabs;

class AuthorTabs extends CiTabs
{
    public function make()
    {
        $this->group('author_information', clean(trans('author::authors.tabs.general')))
            ->active()
            ->add($this->general());
    }

    private function general()
    {
        return tap(new CiTab('general', clean(trans('author::authors.tabs.general'))), function (CiTab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['name','is_active','is_verified']);
            $tab->view('author::admin.authors.tabs.general', []);
        });
    } 
    
    

}
