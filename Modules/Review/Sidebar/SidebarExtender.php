<?php

namespace Modules\Review\Sidebar;

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
                   $this->auth->hasAccess('admin.reviews.index')
            );
            $group->item(clean(trans('review::sidebar.reviews')), function (Item $item) {
                $item->weight(20);
                $item->icon('fas fa-star');
                $item->route('admin.reviews.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.reviews.index')
                );
            });
        });
    }
}
