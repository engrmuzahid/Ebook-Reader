<?php

namespace Modules\Category\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Base\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(clean(trans('ebook::sidebar.ebooks')), function (Group $group) {
            $group->authorize(
                   $this->auth->hasAccess('admin.categories.index') 
            );
            $group->item(clean(trans('category::sidebar.categories')), function (Item $item) {
                $item->weight(5);
                $item->icon('fas fa-tags');
                $item->route('admin.categories.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.categories.index')
                );
            });
        });
    }
}
