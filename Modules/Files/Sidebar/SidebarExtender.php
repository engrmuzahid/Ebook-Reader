<?php

namespace Modules\Files\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Base\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(clean(trans('files::files.media')), function (Group $group) {
            $group->weight(10);
            $group->authorize(
                   $this->auth->hasAccess('admin.files.index') 
            );
            $group->item(clean(trans('files::files.files')), function (Item $item) {
                $item->weight(10);
                $item->icon('fas fa-folder-open');
                $item->route('admin.files.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.files.index')
                );
            });
        });
    }
}
