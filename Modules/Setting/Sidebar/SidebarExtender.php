<?php

namespace Modules\Setting\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Base\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(clean(trans('setting::sidebar.settings')), function (Group $group) {
            $group->weight(50);
            $group->authorize(
                   $this->auth->hasAccess('admin.settings.edit') || $this->auth->hasAccess('admin.translations.index')
            );
            $group->item(clean(trans('setting::sidebar.settings')), function (Item $item) {
                $item->icon('flaticon-settings');
                $item->weight(15);
                $item->route('admin.settings.edit');
                $item->authorize(
                    $this->auth->hasAccess('admin.settings.edit')
                );
            });
        });
    }
}
