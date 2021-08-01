<?php

namespace Modules\User\Admin\Tabs;

use Modules\Admin\Ui\CiTab;
use Modules\Admin\Ui\CiTabs;
use Modules\User\Repositories\Permission;

class RoleTabs extends CiTabs
{
    public function make()
    {
        $this->group('role_information', clean(trans('user::roles.tabs.role_information')))
            ->active()
            ->add($this->general())
            ->add($this->permissions());
    }

    private function general()
    {
        return tap(new CiTab('general', clean(trans('user::roles.tabs.general'))), function (CiTab $tab) {
            $tab->active();
            $tab->weight(10);
            $tab->fields('name');
            $tab->view('user::admin.roles.tabs.general');
        });
    }

    private function permissions()
    {
        return tap(new CiTab('permissions', clean(trans('user::roles.tabs.permissions'))), function (CiTab $tab) {
            $tab->weight(20);

            $tab->view(function ($data) {
                return view('user::admin.permissions.index', [
                    'entity' => $data['role'],
                    'permissions' => Permission::all(),
                ]);
            });
        });
    }
}
