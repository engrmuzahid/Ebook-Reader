<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Author\Entities\Author;
use Modules\Author\Http\Requests\FrontSaveAuthorRequest;
use Modules\Files\Entities\Files;
use DB;

class AccountAuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors=Author::where('user_id',auth()->user()->id)
                ->withoutGlobalScope('active')->latest()
                ->paginate(10);
                
        
        return view('public.account.authors.index', compact('authors'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!setting('enable_ebook_upload'))
        {
              return redirect()->route('home');
        }
        if(!auth()->user())
        {
            return redirect()->route('login');
        }
        return view('public.account.authors.create');
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param \Modules\Ebook\Http\Requests\StoreEbookRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FrontSaveAuthorRequest $request)
    {
        $user_id=auth()->user()->id;
        $data=[
            'name'=>$request->name,
            'description'=>strip_tags($request->description),
            'is_active'=>1,
            'is_verified'=>0,
            'user_id'=>$user_id,
            
        ];
        
        $author=Author::create($data); 
        if($request->hasFile('author_image'))
        {
            $file_image = $request->file('author_image');
            $path_image = Storage::putFile('media', $file_image);
            $author_image=Files::create([
                'user_id' => $user_id,
                'disk' => config('filesystems.default'),
                'filename' => $file_image->getClientOriginalName(),
                'path' => $path_image,
                'extension' => $file_image->guessClientExtension() ?? '',
                'mime' => $file_image->getClientMimeType(),
                'size' => $file_image->getSize(),
            ]);
            DB::table('entity_files')->insert([
                'files_id' => $author_image->id,
                'entity_type'=>'Modules\Author\Entities\Author',
                'entity_id'=>$author->id,
                'zone'=>'author_image',
                'created_at'=>$author_image->created_at,
                'updated_at'=>$author_image->updated_at,
            ]);
        }
        return redirect()->route('account.authors.index')->withSuccess(clean(trans('cynoebook::account.authors.save_author_success')));
    }
    
    /**
     * Show the form for edit resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user())
        {
            return abort(404);
        }
        $author = Author::with([
            'files'
        ])->withoutGlobalScope('active')->where(['id'=>$id,'user_id'=>auth()->user()->id])->firstOrFail();
        
        return view('public.account.authors.edit',['author'=> $author]);
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,FrontSaveAuthorRequest $request)
    {
        $user_id=auth()->user()->id;
        $author = Author::where(['user_id'=>$user_id])->findOrFail($id);
        
        $author->name=$request->name;
        $author->slug=$request->slug;
        $author->description=strip_tags($request->description);
        $author->save();
        if($request->hasFile('author_image'))
        {
            $file_image = $request->file('author_image');
            $path_image = Storage::putFile('media', $file_image);
            $author_image=Files::create([
                'user_id' => $user_id,
                'disk' => config('filesystems.default'),
                'filename' => $file_image->getClientOriginalName(),
                'path' => $path_image,
                'extension' => $file_image->guessClientExtension() ?? '',
                'mime' => $file_image->getClientMimeType(),
                'size' => $file_image->getSize(),
            ]);
            DB::table('entity_files')->insert([
                'files_id' => $author_image->id,
                'entity_type'=>'Modules\Author\Entities\Author',
                'entity_id'=>$author->id,
                'zone'=>'author_image',
                'created_at'=>$author_image->created_at,
                'updated_at'=>$author_image->updated_at,
            ]);
        }
       return redirect()->route('account.authors.index')->withSuccess(clean(trans('cynoebook::account.authors.update_author_success')));
    }
}
