<?php

namespace Themes\Cynoebook\Sidebar;

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
                   $this->auth->hasAccess('admin.cynoebook.edit')
            );
            $group->item(clean(trans('cynoebook::sidebar.theme_settings')), function (Item $item) {
                $item->weight(20);
                $item->icon('fas fa-desktop');
                $item->route('admin.cynoebook.settings.edit');
                $item->authorize(
                    $this->auth->hasAccess('admin.cynoebook.edit')
                );
            });
        });
    }
}
