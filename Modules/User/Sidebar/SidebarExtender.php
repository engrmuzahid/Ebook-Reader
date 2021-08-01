<?php

namespace Modules\User\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Base\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(clean(trans('user::sidebar.accounts')), function (Group $group) {
            $group->weight(20);
            $group->authorize(
                $this->auth->hasAccess('admin.users.index') || $this->auth->hasAccess('admin.roles.index')
            );
            // users
             $group->item(clean(trans('user::sidebar.users')), function (Item $item) {
                $item->weight(5);
                $item->icon('fas fa-users');
                $item->route('admin.users.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.users.index')
                );
            });

            // roles
            $group->item(clean(trans('user::sidebar.roles')), function (Item $item) {
                $item->weight(10);
                $item->icon('fas fa-user-tag');
                $item->route('admin.roles.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.roles.index')
                );
            });
            
        });
    }
}
