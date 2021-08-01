<?php

namespace Themes\Cynoebook\Admin;

use Illuminate\Support\Facades\DB;
use Modules\Admin\Ui\CiTab;
use Modules\Admin\Ui\CiTabs;;
use Modules\Menu\Entities\Menu;
use Modules\Page\Entities\Page;
use Modules\Files\Entities\Files;
use Modules\Slider\Entities\Slider;
use Modules\Ebook\Entities\Ebook;
use Modules\Category\Entities\Category;
use Illuminate\Support\Arr;

class CynoebookTabs extends CiTabs
{
    /**
     * Make new tabs with groups.
     *
     * @return void
     */
    public function make()
    {
        $this->group('general_settings', clean(trans('cynoebook::cynoebook.tabs.group.general_settings')))
            ->active()
            ->add($this->general())
            ->add($this->logo())
            ->add($this->menus())
            ->add($this->socialLinks())
            ->add($this->contact())
            ->add($this->advertisement());
            

        $this->group('home_page_sections', clean(trans('cynoebook::cynoebook.tabs.group.home_page_sections')))
            ->add($this->sliderBanners())
            ->add($this->homeAdvertisement1())
            //->add($this->features())
            ->add($this->eBookFeaturedCarousel())
            ->add($this->eBookPopularCarousel())
            ->add($this->bannerSectionOne())
            ->add($this->authorsSection())
            ->add($this->homeAdvertisement2())
            ->add($this->recentEbooks())
            ->add($this->bannerSectionTwo())
            ->add($this->categoryTabs())
            ->add($this->homeAdvertisement3())
            ->add($this->usersSection());
            
    }

    private function general()
    {
        return tap(new CiTab('general', clean(trans('cynoebook::cynoebook.tabs.general'))), function (CiTab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['cynoebook_slider', 'cynoebook_copyright_text']);
            $tab->view('admin.cynoebook.tabs.general', [
                'pages' => $this->getPages(),
                'sliders' => $this->getSliders(),
            ]);
        });
    }

    private function getPages()
    {
        $pages = Page::all()->pluck('name', 'id');

        return $pages->prepend(clean(trans('cynoebook::cynoebook.form.please_select')), '');
    }

    private function getSliders()
    {
        $sliders = Slider::all()->sortBy('name')->pluck('name', 'id');

        return $sliders->prepend(clean(trans('cynoebook::cynoebook.form.please_select')), '');
    }

    private function logo()
    {
        return tap(new CiTab('logo', clean(trans('cynoebook::cynoebook.tabs.logo'))), function (CiTab $tab) {
            $tab->weight(10);

            $favicon = Files::findOrNew(setting('cynoebook_favicon'));
            $headerLogo = Files::findOrNew(setting('cynoebook_header_logo'));
            $footerLogo = Files::findOrNew(setting('cynoebook_footer_logo'));
            $mailLogo = Files::findOrNew(setting('cynoebook_mail_logo'));

            $tab->view('admin.cynoebook.tabs.logo', compact('favicon', 'headerLogo', 'footerLogo', 'mailLogo'));
        });
    }

    private function menus()
    {
        return tap(new CiTab('menus', clean(trans('cynoebook::cynoebook.tabs.menus'))), function (CiTab $tab) {
            $tab->weight(15);

            $tab->fields([
                'cynoebook_primary_menu',
                'cynoebook_category_menu',
                'cynoebook_category_menu_title',
                'cynoebook_footer_menu',
                'cynoebook_footer_menu_title',
            ]);

            $tab->view('admin.cynoebook.tabs.menus', [
                'menus' => $this->getMenus(),
            ]);
        });
    }

    private function getMenus()
    {
        $menus = Menu::all()->pluck('name', 'id');
        return $menus->prepend(clean(trans('cynoebook::cynoebook.form.please_select')),""); 
        
    }

    private function socialLinks()
    {
        return tap(new CiTab('social_links', clean(trans('cynoebook::cynoebook.tabs.social_links'))), function (CiTab $tab) {
            $tab->weight(20);

            $tab->fields([
                'cynoebook_fb_link',
                'cynoebook_twitter_link',
                'cynoebook_instagram_link',
                'cynoebook_linkedin_link',
                'cynoebook_pinterest_link',
                'cynoebook_gplus_link',
                'cynoebook_youtube_link',
            ]);

            $tab->view('admin.cynoebook.tabs.social_links');
        });
    }
    
    private function contact()
    {
        return tap(new CiTab('contact', clean(trans('cynoebook::cynoebook.tabs.contact'))), function (CiTab $tab) {
            $tab->weight(25);
            $tab->view('admin.cynoebook.tabs.contact');
        });
    }
    
    private function advertisement()
    {
        return tap(new CiTab('advertisement', clean(trans('cynoebook::cynoebook.tabs.advertisement'))), function (CiTab $tab) {
            $tab->weight(30);
            $tab->view('admin.cynoebook.tabs.advertisement');
        });
    }

    private function sliderBanners()
    {
        if (setting('cynoebook_layout') !== 'default') {
            return;
        }

        return tap(new CiTab('slider_banners', clean(trans('cynoebook::cynoebook.tabs.slider_banners'))), function (CiTab $tab) {
            $tab->weight(10);
            $tab->view('admin.cynoebook.tabs.slider_banners', [
                'banner' => Banner::findByName('cynoebook_slider_banner'),
            ]);
        });
    }
    
    private function homeAdvertisement1()
    {
        return tap(new CiTab('homeAdvertisement1', clean(trans('cynoebook::cynoebook.tabs.home_advertisement_1'))), function (CiTab $tab) {
            $tab->weight(15);
            $tab->view('admin.cynoebook.tabs.home_advertisement_1');
        });
    } 
    
    private function features()
    {
        return tap(new CiTab('features', clean(trans('cynoebook::cynoebook.tabs.features'))), function (CiTab $tab) {
            $tab->weight(20);
            $tab->view('admin.cynoebook.tabs.features');
        });
    }
    
    
    
    private function eBookFeaturedCarousel()
    {
        return tap(new CiTab('eBook_featured_carousel', clean(trans('cynoebook::cynoebook.tabs.eBook_featured_carousel'))), function (CiTab $tab) {
            $tab->weight(25);
            $tab->view('admin.cynoebook.tabs.eBook_featured_carousel');
        });
    }
    
    private function bannerSectionOne()
    {
        return tap(new CiTab('banner_section_1', clean(trans('cynoebook::cynoebook.tabs.banner_section_1'))), function (CiTab $tab) {
            $tab->weight(30);
            $tab->view('admin.cynoebook.tabs.banner_section_1', [
                'banner' => Banner::findByName('cynoebook_banner_section_1_banner'),
            ]);
        });
    }
    
    private function eBookPopularCarousel()
    {
        return tap(new CiTab('eBook_popular_carousel', clean(trans('cynoebook::cynoebook.tabs.eBook_popular_carousel'))), function (CiTab $tab) {
            $tab->weight(25);
            $tab->view('admin.cynoebook.tabs.eBook_popular_carousel');
        });
    }
    
    private function authorsSection()
    {
        return tap(new CiTab('author_sections', clean(trans('cynoebook::cynoebook.tabs.author_sections'))), function (CiTab $tab) {
            $tab->weight(30);
            $tab->view('admin.cynoebook.tabs.author_sections');
        });
    }
    
    private function homeAdvertisement2()
    {
        return tap(new CiTab('homeAdvertisement2', clean(trans('cynoebook::cynoebook.tabs.home_advertisement_2'))), function (CiTab $tab) {
            $tab->weight(35);
            $tab->view('admin.cynoebook.tabs.home_advertisement_2');
        });
    } 
    
    private function recentEbooks()
    {
        return tap(new CiTab('recent_ebooks', clean(trans('cynoebook::cynoebook.tabs.recent_ebooks'))), function (CiTab $tab) {
            $tab->weight(40);
            $tab->view('admin.cynoebook.tabs.recent_ebooks');
        });
    }
    
    

    private function bannerSectionTwo()
    {
        return tap(new CiTab('banner_section_2', clean(trans('cynoebook::cynoebook.tabs.banner_section_2'))), function (CiTab $tab) {
            $tab->weight(45);
            $tab->view('admin.cynoebook.tabs.banner_section_2', [
                'banner' => Banner::findByName('cynoebook_banner_section_2_banner'),
            ]);
        });
    }
    
    private function categoryTabs()
    {
        
        
        return tap(new CiTab('category_tabs', clean(trans('cynoebook::cynoebook.tabs.popular_categories_tabs'))), function (CiTab $tab) {
            $tab->weight(50);
            $tab->view('admin.cynoebook.tabs.category_tabs', [
                'categories' => $this->getCategories(),
            ]);
        });
    }
    
    private function getCategories()
    {
        $categories=Category::treeList();
        
        return Arr::prepend($categories, clean(trans('cynoebook::cynoebook.form.please_select')),''); 
        
    }
    
    private function homeAdvertisement3()
    {
        return tap(new CiTab('homeAdvertisement3', clean(trans('cynoebook::cynoebook.tabs.home_advertisement_3'))), function (CiTab $tab) {
            $tab->weight(50);
            $tab->view('admin.cynoebook.tabs.home_advertisement_3');
        });
    }
    
    private function usersSection()
    {
        return tap(new CiTab('users_sections', clean(trans('cynoebook::cynoebook.tabs.users_sections'))), function (CiTab $tab) {
            $tab->weight(55);
            $tab->view('admin.cynoebook.tabs.users_sections');
        });
    }
    
}
