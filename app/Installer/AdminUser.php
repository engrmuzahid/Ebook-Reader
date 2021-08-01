<?php

namespace App\Installer;

use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

class AdminUser
{
    public function setup($data)
    {
        $role = Role::create(['name' => 'Admin', 'permissions' => $this->getAdminRolePermissions()]);

        $admin = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $activation = Activation::create($admin);
        Activation::complete($admin, $activation->code);

        $admin->roles()->attach($role);
    }

    private function getAdminRolePermissions()
    {
        return [
            // users
            'admin.users.index' => true,
            'admin.users.create' => true,
            'admin.users.edit' => true,
            'admin.users.destroy' => true,
            // roles
            'admin.roles.index' => true,
            'admin.roles.create' => true,
            'admin.roles.edit' => true,
            'admin.roles.destroy' => true,
            // menus
            'admin.menus.index' => true,
            'admin.menus.create' => true,
            'admin.menus.edit' => true,
            'admin.menus.destroy' => true,
            'admin.menu_items.index' => true,
            'admin.menu_items.create' => true,
            'admin.menu_items.edit' => true,
            'admin.menu_items.destroy' => true,
            // Media Files
            'admin.files.index' => true,
            'admin.files.create' => true,
            'admin.files.destroy' => true,
            // pages
            'admin.pages.index' => true,
            'admin.pages.create' => true,
            'admin.pages.edit' => true,
            'admin.pages.destroy' => true,
            // translations
            'admin.translations.index' => true,
            'admin.translations.edit' => true,
            // settings
            'admin.settings.edit' => true,
            //eBook
            'admin.ebooks.index' => true,
            'admin.ebooks.create' => true,
            'admin.ebooks.edit' => true,
            'admin.ebooks.destroy' => true,
            //Reported eBook
            'admin.reportedebooks.index' => true,
            'admin.reportedebooks.destroy' => true,
            // reviews
            'admin.reviews.index' => true,
            'admin.reviews.create' => true,
            'admin.reviews.edit' => true,
            'admin.reviews.destroy' => true,
            // import
            'admin.importer.index' => true,
            'admin.importer.create' => true,
            // sliders
            'admin.sliders.index' => true,
            'admin.sliders.create' => true,
            'admin.sliders.edit' => true,
            'admin.sliders.destroy' => true,
            // categories
            'admin.categories.index' => true,
            'admin.categories.create' => true,
            'admin.categories.edit' => true,
            'admin.categories.destroy' => true,
            // Authors
            'admin.authors.index' => true,
            'admin.authors.create' => true,
            'admin.authors.edit' => true,
            'admin.authors.destroy' => true,
            // Activity
            'admin.activity.index' => true,
            // cynoebook
            'admin.cynoebook.edit' => true,
            
        ];
    }
}
