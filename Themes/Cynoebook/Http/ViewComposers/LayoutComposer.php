<?php

namespace Themes\Cynoebook\Http\ViewComposers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\Menu\Entities\Menu;
use Modules\Files\Entities\Files;
use Modules\Menu\MegaMenu\MegaMenu;
use Modules\Category\Entities\Category;

class LayoutComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        $view->with([
            'theme' => $this->getTheme(),
            'favicon' => $this->getFavicon(),
            'headerLogo' => $this->getHeaderLogo(),
            'categories' => $this->getCategories(),
            'primaryMenu' => $this->getPrimaryMenu(),
            'categoryMenu' => $this->getCategoryMenu(),
            'shouldExpandCategoryMenu' => $this->getShouldExpandCategoryMenu(),
            'footerLogo' => $this->getFooterLogo(),
            'footerMenu1' => $this->getFooterMenu1(),
            'footerMenu2' => $this->getFooterMenu2(),
            'socialLinks' => $this->getSocialLinks(),
            'copyrightText' => $this->getCopyrightText(),
            'newsletterBgImage' => $this->getNewsletterBgImage(),
        ]);
    }

    private function getTheme()
    {
        return setting('cynoebook_theme', 'theme-black');
    }

    private function getFavicon()
    {
        return $this->getLogo('cynoebook_favicon');
    }

    private function getHeaderLogo()
    {
        return $this->getLogo('cynoebook_header_logo');
    }

    private function getLogo($key)
    {
        return Files::findOrNew(setting($key))->path;
    }

    private function getCategories()
    {
        return Category::searchable();
    }

    private function getPrimaryMenu()
    {
        return new MegaMenu(setting('cynoebook_primary_menu'));
    }

    private function getCategoryMenu()
    {
        return new MegaMenu(setting('cynoebook_category_menu'));
    }

    private function getShouldExpandCategoryMenu()
    {
        $layout = cynoebook_layout();

        if ($layout === 'default' || $layout === 'slider_layout') {
            return request()->routeIs('home');
        }

        return true;
    }
    
    private function getFooterLogo()
    {
        return $this->getLogo('cynoebook_footer_logo');
    }

    private function getFooterMenu1()
    {
        $menuId = setting('cynoebook_footer_menu_1');

        return Cache::tags(['menu_items', 'categories', 'pages', 'settings'])
            ->rememberForever("cynoebook_footer_menu.{$menuId}:" . locale(), function () use ($menuId) {
                return Menu::for($menuId);
            });
    }
    
    private function getFooterMenu2()
    {
        $menuId = setting('cynoebook_footer_menu_2');

        return Cache::tags(['menu_items', 'categories', 'pages', 'settings'])
            ->rememberForever("cynoebook_footer_menu.{$menuId}:" . locale(), function () use ($menuId) {
                return Menu::for($menuId);
            });
    }

    private function getSocialLinks()
    {
        return collect([
            'facebook-official' => setting('cynoebook_fb_link'),
            'twitter' => setting('cynoebook_twitter_link'),
            'instagram' => setting('cynoebook_instagram_link'),
            'linkedin' => setting('cynoebook_linkedin_link'),
            'pinterest' => setting('cynoebook_pinterest_link'),
            'google-plus' => setting('cynoebook_google_plus_link'),
            'youtube' => setting('cynoebook_youtube_link'),
        ])->reject(function ($link) {
            return is_null($link);
        });
    }

    private function getCopyrightText()
    {
        $replacements = [
            //'site_url' => route('home'),
            'site_name' => strip_tags(setting('site_name')),
            'year' => date('Y'),
        ];

        $copyrightText = setting('cynoebook_copyright_text');

        foreach ($replacements as $key => $replacement) {
            $copyrightText = str_replace("{{ $key }}", $replacement, $copyrightText);
        }

        return $copyrightText;
    }
    
    private function getNewsletterBgImage()
    {
        return $this->getLogo('newsletter_bg_image');
    }
}
