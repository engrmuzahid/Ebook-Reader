<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['slug'=>'admin','name' => 'Admin', 'permissions' => $this->getAdminRolePermissions()]);

        Role::create(['slug'=>'user','name' => 'User','permissions' => $this->getUserRolePermissions()]);
    }

    /**
     * Get admin role permissions.
     *
     * @return array
     */
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
            // Media
            'admin.media.index' => true,
            'admin.media.create' => true,
            'admin.media.destroy' => true,
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
            // cynoebook
            'admin.cynoebook.edit' => true,
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
            // Activity
            'admin.activity.index' => true,
            
        ];
    }
    
    /**
     * Get user role permissions.
     *
     * @return array
     */
    private function getUserRolePermissions()
    {
        return [];
    }
}
