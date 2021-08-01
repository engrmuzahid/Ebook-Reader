<?php

namespace Modules\Menu\Admin\Tabs;

use Modules\Admin\Ui\CiTab;
use Modules\Admin\Ui\CiTabs;
use Modules\Page\Entities\Page;
use Modules\Menu\Entities\Menu;

class MenuTabs extends CiTabs
{
    /**
     * Make new tabs with groups.
     *
     * @return void
     */
    public function make()
    {
        $this->group('menu_information', clean(trans('menu::menus.tabs.group.menu_information')))
            ->active()
            ->add($this->general())
            ->add($this->menuItem());
    }

    private function general()
    {
        return tap(new CiTab('general', clean(trans('menu::menus.tabs.general'))), function (CiTab $tab) {
            if (! request()->routeIs('admin.menus.edit') || !auth()->user()->hasAccess('admin.menu_items.index')) {
                $tab->active();
            }
            $tab->weight(5);
            $tab->view('menu::admin.menus.tabs.general', [
                //'parentMenuItems' => $this->parentMenuItems(),
            ]);
        });
    }
    
    private function menuItem()
    {
        
        if (! request()->routeIs('admin.menus.edit') || !auth()->user()->hasAccess('admin.menu_items.index')) {
            return;
        }
        return tap(new CiTab('menuItem', clean(trans('menu::menus.tabs.menu_items'))), function (CiTab $tab) {
            $tab->weight(10);
            $tab->active();
            $tab->view('menu::admin.menus.tabs.menuItem', [
                'menuItems' => $this->menuItems(),
            ]);
        });
    }

    private function menuItems()
    {
        $id=request()->id;
        $menu = Menu::withoutGlobalScope('active')->findOrFail($id);
        $menuItems = $menu->menuItems()
            ->withoutGlobalScope('active')
            ->withoutGlobalScope('not_root')
            ->get()
            ->nest();

        return $menuItems;
    }
}
