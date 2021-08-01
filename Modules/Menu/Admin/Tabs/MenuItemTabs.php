<?php

namespace Modules\Menu\Admin\Tabs;

use Modules\Admin\Ui\CiTab;
use Modules\Admin\Ui\CiTabs;
use Modules\Page\Entities\Page;
use Modules\Menu\Entities\MenuItem;
use Modules\Category\Entities\Category;

class MenuItemTabs extends CiTabs
{
    /**
     * Make new tabs with groups.
     *
     * @return void
     */
    public function make()
    {
        $this->group('menu_item_information', clean(trans('menu::menu_items.tabs.group.menu_item_information')))
            ->active()
            ->add($this->general());
    }

    private function general()
    {
        return tap(new CiTab('general', clean(trans('menu::menu_items.tabs.general'))), function (CiTab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->view('menu::admin.menu_items.tabs.general', [
                'categories' => $this->categories(),
                'pages' => $this->pages(),
                'parentMenuItems' => $this->parentMenuItems(),
            ]);
        });
    }

    private function categories()
    {
        $categories = Category::where('parent_id', null)->get()->sortBy('name')->pluck('name', 'id');

        return $categories->prepend(clean(trans('menu::menu_items.form.select_category')), '');
    }

    private function pages()
    {
        $pages = Page::all()->sortBy('name')->pluck('name', 'id');

        return $pages->prepend(clean(trans('menu::menu_items.form.select_page')), '');
    }

    private function parentMenuItems()
    {
        $parentMenuItems = ['' => clean(trans('menu::menu_items.form.select_parent'))];

        return $parentMenuItems += MenuItem::parents(request('menuId'), request('id'));
    }
}
