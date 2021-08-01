<?php
namespace Modules\Setting\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
use Modules\Ebook\Entities\Ebook;
use Modules\User\Entities\User;
use Modules\Page\Entities\Page;
use Modules\Author\Entities\Author;
use Modules\Category\Entities\Category;


class SitemapController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $sitemap =  Sitemap::create();
        $sitemap->add(Url::create('/')
            ->setLastModificationDate(Carbon::today())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(1.0));
            
        
        //Ebooks
		$ebooks = Ebook::where(['is_active'=>1,"deleted_at"=>null])->get();
		foreach ($ebooks as $ebook):
            $bookURL=route('ebooks.show', $ebook->slug);
            $sitemap->add(
                Url::create($bookURL)
                ->setLastModificationDate($ebook->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
        endforeach;
        
        //Pages
        $pages = Page::where('is_active',1)->get();
		foreach ($pages as $page):
            $sitemap->add(
                Url::create($page->slug)
                ->setLastModificationDate($page->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        endforeach;
        
        //Categories
        $categories = Category::where('is_active',1)->get();
		foreach ($categories as $category):
            $categoryURL=route('ebooks.index', ['category' => $category->slug]);
            $sitemap->add(
                Url::create($categoryURL)
                ->setLastModificationDate($category->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        endforeach;
        
        //Authors
        $authors = Author::where(['is_active'=>1,'is_verified'=>1])->get();
        foreach ($authors as $author):
            $authorURL=route('authors.show', $author->slug);
            $sitemap->add(
                Url::create($authorURL)
                ->setLastModificationDate($author->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        endforeach;
        
        
		$sitemap->writeToFile('sitemap.xml');

        return back()->withSuccess(clean(trans('setting::messages.sitemap_successfully_updated')));
        
    }

}
