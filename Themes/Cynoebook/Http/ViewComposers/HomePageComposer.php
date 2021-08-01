<?php

namespace Themes\Cynoebook\Http\ViewComposers;

use Illuminate\Support\Collection;
use Modules\Slider\Entities\Slider;
use Modules\Ebook\Entities\Ebook;
use Modules\Author\Entities\Author;
use Modules\User\Entities\User;
use Themes\Cynoebook\Admin\Banner;
use DB;

class HomePageComposer
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
            'slider' => $this->getSlider(),
            'sliderBanners' => $this->getSliderBanners(),
            //'features' => $this->getFeatures(),
            'recentEbooks' => $this->getRecentEbooks(),
            'bannerSectionOneBanner' => $this->getBannerSectionOneBanner(),
            'bannerSectionTwoBanner' => $this->getBannerSectionTwoBanner(),
            'carouselEbooks' => $this->getCarouselFeaturedEbook(),
            'popularEbooks' => $this->getCarouselPopularEbook(),
            'homeAdvertisement1' => $this->getHomeAdvertisement(1),
            'homeAdvertisement2' => $this->getHomeAdvertisement(2),
            'homeAdvertisement3' => $this->getHomeAdvertisement(3),
            'categoryTabEbook' => $this->getCategoryTabEbook(),
            'topAuthors' => $this->getAuthors(),
            'topUsers' => $this->getUsers(),
        ]);
    }
    
    private function getSlider()
    {
        $slider=setting('cynoebook_slider');
        if(!is_null($slider) && $slider!='' )
        {
            return Slider::findWithSlides($slider);    
        }
        
        return '';
        
    }
    
    private function getSliderBanners()
    {
        
        return Banner::findByName('cynoebook_slider_banner');
        
    }
    
    private function getFeatures()
    {
        if (! setting('cynoebook_features_section_enabled')) {
            return collect();
        }

        return Collection::times(4, function ($number) {
            return $this->getFeatureFor($number);
        })->filter(function ($feature) {
            return ! is_null($feature['icon']);
        });
    }

    private function getFeatureFor($number)
    {
        return [
            'icon' => setting("cynoebook_feature_{$number}_icon"),
            'title' => setting("cynoebook_feature_{$number}_title"),
            'subtitle' => setting("cynoebook_feature_{$number}_subtitle"),
        ];
    }
    
    private function getRecentEbooks()
    {
        
        if (! setting('cynoebook_recent_ebooks_section_enabled')) {
            return collect();
        }

        return Ebook::with(['user','categories','authors'])->isPrivate()->latest()
            ->take(setting('cynoebook_recent_ebooks_section_total_ebooks', 10))
            ->get();
    }
    
    private function getBannerSectionOneBanner()
    {
        if (setting('cynoebook_banner_section_1_enabled')) {
            return Banner::findByName('cynoebook_banner_section_1_banner');
        }
    }

    
    private function getBannerSectionTwoBanner()
    {
        if (setting('cynoebook_banner_section_2_enabled')) {
            return Banner::findByName('cynoebook_banner_section_2_banner');
        }
    }

    private function getCarouselFeaturedEbook()
    {
        if (! setting('cynoebook_featured_ebooks_carousel_section_enabled')) {
            return collect();
        }

        return $this->getFeaturedEbook();
    }
    
    private function getCarouselPopularEbook()
    {
        if (! setting('cynoebook_popular_ebooks_carousel_section_enabled')) {
            return collect();
        }
        $total=setting('cynoebook_popular_ebooks_section_total_ebooks', 10);
        $by=setting('cynoebook_popular_ebooks_by');
        if($by==''){ $by='review'; }
        if($by=='view'){
            return Ebook::with(['user','categories','authors'])
                ->isPrivate()
                ->orderBy('viewed', 'desc')
                ->latest()
                ->take($total)
                ->get();
        }
        
        if($by=='review'){
            return $ebooks = Ebook::with(['user','categories','authors'])
                ->isPrivate()
                ->leftJoin('reviews', 'ebooks.id', '=', 'reviews.ebook_id')
                ->select(['ebooks.*',
                    DB::raw('AVG(reviews.rating) as avg_rating')
                    ])
                ->groupBy([
                    'ebooks.id',
                    'slug',
                    'user_id',
                    'publication_year',
                    'file_type',
                    'file_url',
                    'embed_code',
                    'isbn',
                    'price',
                    'buy_url',
                    'viewed',
                    'password',
                    'is_featured',
                    'is_active',
                    'is_private',
                    'user_id',
                    'ebooks.created_at',
                    'ebooks.deleted_at',
                    'ebooks.updated_at',
                ])
                ->orderBy('avg_rating', 'DESC')
                ->orderBy('ebooks.id', 'DESC')
                ->take($total)
                ->get();
            
        }
        
    }
    
    private function getFeaturedEbook()
    {
        return Ebook::with(['user','categories','authors'])->isPrivate()->where('is_featured',1)->latest()
            ->take(setting('cynoebook_featured_ebooks_section_total_ebooks', 10))
            ->get();
    }
    
    private function getHomeAdvertisement($number)
    {
         
        if (setting("cynoebook_home_ad{$number}_section_enabled")) {
           return  setting("cynoebook_home_ad_{$number}");
        }
        return collect();
        
    }
    
    private function getCategoryTabEbook()
    {
        if (! setting('cynoebook_category_tabs_section_enabled')) {
            return collect();
        }

        return [
            'tab_1' => $this->getEbookByCategory(
            setting('cynoebook_category_tabs_section_tab_1_category'),
            setting('cynoebook_category_tabs_section_tab_1_total_ebooks',10)
            ),
            'tab_2' => $this->getEbookByCategory(
            setting('cynoebook_category_tabs_section_tab_2_category'),
            setting('cynoebook_category_tabs_section_tab_2_total_ebooks',10)
            ),
            'tab_3' => $this->getEbookByCategory(
            setting('cynoebook_category_tabs_section_tab_3_category'),
            setting('cynoebook_category_tabs_section_tab_3_total_ebooks',10)
            ),
            'tab_4' => $this->getEbookByCategory(
            setting('cynoebook_category_tabs_section_tab_4_category'),
            setting('cynoebook_category_tabs_section_tab_4_total_ebooks',10)
            ),
            'tab_5' => $this->getEbookByCategory(
            setting('cynoebook_category_tabs_section_tab_5_category'),
            setting('cynoebook_category_tabs_section_tab_5_total_ebooks',10)
            ),
        ];
    }
    
    private function getEbookByCategory($categoryId,$totalPage)
    {
        return Ebook::with(['user','categories','authors'])->isPrivate()->whereHas('categories', function ($categoryQuery) use ($categoryId) {
            $categoryQuery->where('id', $categoryId ?:'');
        })->latest()->take($totalPage)->get();
            //$ids ?: []
    }
    
    private function getAuthors()
    {
        if (! setting('cynoebook_authors_section_enabled')) {
            return collect();
        }
        $total=setting('cynoebook_authors_section_total_authors', 4);
        $sort=setting('cynoebook_authors_order_by');
        
        $query=Author::withCount('ebooks')->where(['is_verified'=>1,'is_active'=>1]);
        if($sort=='top_by_book_count'){
            $query->orderBy('ebooks_count','desc');
        }elseif($sort=='oldest'){
            $query->oldest();
        }else{
             $query->latest();
        }
        
        return $authors=$query->take($total)->get();
    }
    
    private function getUsers()
    {
        if (! setting('cynoebook_users_section_enabled')) {
            return collect();
        }
        $total=setting('cynoebook_users_section_total_authors', 4);
        $sort=setting('cynoebook_users_order_by');
        
        $query=User::withCount('ebooks');
        $query->join('activations', 'users.id', '=', 'activations.user_id'); 
        $query->where('activations.completed',1); 
         if($sort=='top_by_book_count'){
             $query->orderBy('ebooks_count','desc');
        }elseif($sort=='oldest'){
            $query->oldest();
        }else{
             $query->latest();
        }
        
        return $users=$query->take($total)->get();
    }
    
}
   
