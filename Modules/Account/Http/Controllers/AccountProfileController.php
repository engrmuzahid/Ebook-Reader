<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\User\Http\Requests\UpdateProfileRequest;
use Modules\User\Entities\User;
use Modules\Ebook\Entities\Ebook;
use Modules\Files\Entities\Files;

use DB;

class AccountProfileController extends Controller
{
    
    public function index()
    {
        $sort='latest';
        if(request()->has('sort')) {
            $sort=request()->sort;
        }
        
        $query=User::withCount('ebooks');
        $query->join('activations', 'users.id', '=', 'activations.user_id'); 
        $query->where('activations.completed',1); 
        if($sort=='alphabetic'){
            $query->orderBy('first_name','asc');
        }elseif($sort=='oldest'){
            $query->oldest();
        }else{
             $query->latest();
        }
        $users=$query->paginate(12)->appends(request()->query());
        
        return view('public.users.index',compact('users'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
       
        $user=User::where('username', $slug)->firstOrFail();
        
        $ebooks=Ebook::forCard()
                ->where('user_id',$user->id)
                ->where('is_private',0)
                ->paginate(9)->appends(request()->query());
        return view('public.account.profile.show', compact('user', 'ebooks'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $my = auth()->user();

        return view('public.account.profile.edit', compact('my'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Modules\User\Http\Requests\UpdateProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        //$request->merge(clean($request->all()));
        if($request->hasFile('avatar'))
        {
            $file_image = $request->file('avatar');
            $extension=$file_image->guessClientExtension();
            
            if(!in_array($extension,['png','jpg','jpeg'])){
                return back()->withError(clean(trans('base::validation.mimes',['attribute'=>'Avatar','values'=>'jpg,jpeg,png'])));
            }
        }
        $this->bcryptPassword($request);
        auth()->user()->update($request->all());
        
        if($request->hasFile('avatar'))
        {
            $file_image = $request->file('avatar');
            $path_image = Storage::putFile('media', $file_image);
            $avatar=Files::create([
                'user_id' => auth()->user()->id,
                'disk' => config('filesystems.default'),
                'filename' => $file_image->getClientOriginalName(),
                'path' => $path_image,
                'extension' => $file_image->guessClientExtension() ?? '',
                'mime' => $file_image->getClientMimeType(),
                'size' => $file_image->getSize(),
            ]);
            auth()->user()->files()->wherePivot('zone', 'avatar')->detach();
            DB::table('entity_files')->insert([
                [
                    'files_id' => $avatar->id,
                    'entity_type'=>'Modules\User\Entities\User',
                    'entity_id'=>auth()->user()->id,
                    'zone'=>'avatar',
                    'created_at'=>$avatar->created_at,
                    'updated_at'=>$avatar->updated_at,
                ]
            ]);
        }
        
        return back()->withSuccess(clean(trans('account::messages.profile_updated')));
    }

    /**
     * Bcrypt user password.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function bcryptPassword($request)
    {
        if ($request->filled('password')) {
            return $request->merge(['password' => bcrypt($request->password)]);
        }

        unset($request['password']);
    }
}
