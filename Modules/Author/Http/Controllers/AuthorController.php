<?php

namespace Modules\Author\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Author\Entities\Author;
use Modules\Ebook\Entities\Ebook;
use Modules\Files\Entities\Files;
use Modules\User\Entities\User;
use Modules\User\Contracts\Authentication;


class AuthorController extends Controller
{
    /**
     * The Authentication instance.
     *
     * @var \Modules\User\Contracts\Authentication
     */
    protected $auth;

    /**
     * @param \Modules\User\Contracts\Authentication $auth
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;

    }
    /**
     * Display a listing of the resource.
     *
     * @param \Modules\Ebook\Entities\Ebook $model
     * @param \Modules\Ebook\Filters\EbookFilter $ebookFilter
     * @return \Illuminate\Http\Response
     */
    public function index(/* Ebook $model, EbookFilter $ebookFilter */)
    {
        $sort='latest';
        if(request()->has('sort')) {
            $sort=request()->sort;
        }
        $query=Author::withCount('ebooks')->where(['is_verified'=>1,'is_active'=>1]);
        if($sort=='alphabetic'){
            $query->join('author_translations', 'authors.id', '=', 'author_translations.author_id'); 
             $query->orderBy('author_translations.name','asc');
        }elseif($sort=='oldest'){
            $query->oldest();
        }else{
             $query->latest();
        }
        //dd($query->get());
        $authors=$query->paginate(12)->appends(request()->query());
        
        
        
        
        
        return view('public.authors.index',compact('authors'));
    }
    
    /**
     * Show the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $author=Author::where(['slug'=> $slug,'is_verified'=>1,'is_active'=>1])->firstOrFail();
        $user =auth()->user();
        $ebooks=Ebook::forCard()
                ->where('is_private',0)
                ->whereHas('authors', function ($authorQuery) use ($author) {
                    $authorQuery->where('id', $author->id);
                })
                ->paginate(9)->appends(request()->query());
        return view('public.authors.show', compact('author','user', 'ebooks'));
         
    }
}
