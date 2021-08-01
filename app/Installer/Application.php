<?php

namespace App\Installer;

use Modules\User\Entities\Role;
use Modules\Setting\Entities\Setting;
use Illuminate\Support\Facades\Artisan;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class Application
{
    public function setup()
    {
        $this->generateApplicationKey();
        $this->setEnvVariables();
        $this->createCustomerRole();
       
        $this->setApplicationSettings();
        $this->createStorageFolder();
    }

    private function generateApplicationKey()
    {
        Artisan::call('key:generate', ['--force' => true]);
    }

    private function setEnvVariables()
    {
        $env = DotenvEditor::load();

        $env->setKey('APP_ENV', 'production');
        $env->setKey('APP_DEBUG', 'false');
        $env->setKey('APP_CACHE', 'true');
        $env->setKey('APP_URL', url('/'));

        $env->save();
    }

    private function createCustomerRole()
    {
        Role::create(['slug'=>'user','name' => 'User','permissions' => $this->getUserRolePermissions()]);
    }
    
    private function setApplicationSettings()
    {
        Setting::setMany([
            'active_theme' => 'Cynoebook',
            'supported_locales' => ['en'],
            'default_locale' => 'en',
            'default_timezone' => 'UTC',
            'user_role' => '2',
            'auto_approve_user' => '1',
            'cookie_bar_enabled' => '1',
            'enable_comment' => '1',
            'member_only_reading_books' => '0',
            'enable_ebook_report' => true,
            'enable_ebook_print' => true,
            'enable_ebook_download' => true,
            'enable_ebook_upload' => true,
            'enable_registrations' => true,
            'reviews_enabled' => true,
            'auto_approve_reviews' => true,
            //'cynoebook_copyright_text' => 'Copyright © <a href="{{ site_url }}">{{ site_name }}</a> {{ year }}. All rights reserved.',
            'cynoebook_copyright_text' => 'Copyright © {{ site_name }} {{ year }}. All rights reserved.',
            'allowed_file_types' => ['pdf','epub','docx','doc','txt','mp3','wav'],
            'theme_logo_header_color' => 'blue',
            'theme_navbar_header_color' => 'blue2',
            'theme_sidebar_color' => 'white',
            'theme_background_color' => 'bg1',
        ]);
        
    }

    private function createStorageFolder()
    {
        mkdir(public_path('storage'));
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
