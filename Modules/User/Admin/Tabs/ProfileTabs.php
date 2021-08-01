<?php

namespace Modules\User\Admin\Tabs;

use Modules\Admin\Ui\CiTab;
use Modules\Admin\Ui\CiTabs;

class ProfileTabs extends CiTabs
{
    /**
     * Make new tabs with groups.
     *
     * @return void
     */
    public function make()
    {
        $this->group('profile_information', clean(trans('user::users.tabs.group.profile_information')))
            ->active()
            ->add($this->general())
            ->add($this->profile())
            ->add($this->newPassword());
    }

    private function general()
    {
        return tap(new CiTab('general', clean(trans('user::users.tabs.general'))), function (CiTab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['first_name', 'last_name', 'email']);
            $tab->view('user::admin.profile.tabs.general');
        });
    }
    
    private function profile()
    {
        return tap(new CiTab('profile', clean(trans('user::users.tabs.profile'))), function (CiTab $tab) {
            $tab->weight(15);
            $tab->view('user::admin.profile.tabs.profile');
        });
    }
    
    private function newPassword()
    {
        return tap(new CiTab('newPassword', clean(trans('user::users.tabs.new_password'))), function (CiTab $tab) {
            $tab->weight(20);
            $tab->fields(['password', 'password_confirmation']);
            $tab->view('user::admin.profile.tabs.new_password');
        });
    }
}
