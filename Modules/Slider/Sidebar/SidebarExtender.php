<?php

namespace Modules\Slider\Sidebar;

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
                   $this->auth->hasAccess('admin.sliders.index') 
            );
            $group->item(clean(trans('slider::sidebar.sliders')), function (Item $item) {
                $item->weight(10);
                $item->icon('fas fa-sliders-h');
                $item->route('admin.sliders.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.sliders.index')
                );
            });
        });
    }
}
