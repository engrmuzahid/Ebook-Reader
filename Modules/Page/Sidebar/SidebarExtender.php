<?php

namespace Modules\Page\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Base\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(clean(trans('page::sidebar.cms')), function (Group $group) {
            $group->weight(20);
            $group->authorize(
                   $this->auth->hasAccess('admin.pages.index') 
            );
            $group->item(clean(trans('page::sidebar.pages')), function (Item $item) {
                $item->weight(10);
                $item->icon('fas fa-file');
                $item->route('admin.pages.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.pages.index')
                );
            });
        });
    }
}
