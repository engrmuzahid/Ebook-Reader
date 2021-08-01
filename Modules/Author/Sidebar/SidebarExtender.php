<?php

namespace Modules\Author\Sidebar;

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
                   $this->auth->hasAccess('admin.authors.index') 
            );
            $group->item(clean(trans('author::sidebar.authors')), function (Item $item) {
                $item->weight(5);
                $item->icon('fas fa-book-reader');
                $item->route('admin.authors.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.authors.index')
                );
            });
        });
    }
}
