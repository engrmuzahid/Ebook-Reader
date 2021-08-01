<?php

namespace Modules\Menu\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Base\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(clean(trans('setting::sidebar.settings')), function (Group $group) {
            $group->authorize(
                   $this->auth->hasAccess('admin.menus.index') 
            );
            $group->item(clean(trans('menu::menus.menus')), function (Item $item) {
                $item->weight(5);
                $item->icon('fas fa-bars');
                $item->route('admin.menus.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.menus.index')
                );
            });
        });
    }
}
