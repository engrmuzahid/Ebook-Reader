<?php

namespace Modules\Translation\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Base\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(clean(trans('setting::sidebar.settings')), function (Group $group) {
            $group->item(clean(trans('translation::sidebar.translations')), function (Item $item) {
                $item->weight(20);
                $item->icon('fas fa-globe');
                $item->route('admin.translations.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.translations.index')
                );
            });
        });
        
    }
}
