<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Setting\Entities\Setting;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::setMany([
            'active_theme' => 'Cynoebook',
            'supported_locales' => ['en'],
            'default_locale' => 'en',
            'default_timezone' => 'UTC',
            'user_role' => '2',
            'auto_approve_user' => '1',
            'cookie_bar_enabled' => '1',
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
        ]);
    }
}
