<?php

namespace Modules\Admin\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Base\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(clean(trans('admin::sidebar.main')), function (Group $group) {
            
            $group->weight(5);
            $group->hideHeading();
            
            $group->item(clean(trans('admin::dashboard.dashboard')), function (Item $item) {
                $item->icon('fas fa-home');
                $item->route('admin.dashboard.index');
                $item->isActiveWhen(route('admin.dashboard.index', null, false));
            });
        });
        
       /*  $menu->group(clean(trans('setting::sidebar.settings')), function (Group $group) {
            $group->authorize(
                   $this->auth->hasAccess('admin.activity.index')
            );
            // activity
             $group->item(clean(trans('admin::sidebar.activitylogs')), function (Item $item) {
                $item->weight(50);
                $item->icon('fas fa-user-clock');
                $item->route('admin.activity.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.activity.index')
                );
            });

            
        }); */

    }
}
