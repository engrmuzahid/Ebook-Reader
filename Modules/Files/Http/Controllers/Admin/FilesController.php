<?php

namespace Modules\Files\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Files\Entities\Files;
use Modules\Admin\Traits\HasDefaultActions;
use Modules\Files\Http\Requests\UploadFilesRequest;


class FilesController extends Controller
{
    use HasDefaultActions;
    
    protected $model = Files::class;
    
    protected $label = 'files::files.files';
    
    protected $viewPath = 'files::admin.files';
    
    //protected $validation = UpdateFilesRequest::class;
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filesManager()
    {
        $type = request('type');
        $extension = request('extension');
        return view('files::admin.files.manager', compact('type','extension'));
    }
    
    public function store(UploadFilesRequest $request)
    {
        //$request->merge(clean($request->all()));
        $file = $request->file('file');
        
        $path = Storage::putFile('media', $file);
        //$path = Storage::putFileAs('media', $file,$file->getClientOriginalName());
        $data=Files::create([
            'user_id' => auth()->id(),
            'disk' => config('filesystems.default'),
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'extension' => $file->guessClientExtension() ?? '',
            'mime' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);
        
        activity('file')
                ->performedOn($data)
                ->causedBy(auth()->user())
                ->withProperties(['subject' => $data,'causer'=>auth()->user()])
                ->log('created');
        

        return response('Created', Response::HTTP_CREATED);
    }
    
    public function destroy($ids)
    {
        $delete_id=explode(',', $ids);
        foreach($delete_id as $id)
        {
            $entity=Files::findById($id);
            activity('file')
                ->performedOn($entity)
                ->causedBy(auth()->user())
                ->withProperties(['subject' => $entity,'causer'=>auth()->user()])
                ->log('deleted');
        }
        Files::find(explode(',', $ids))->each->delete();
    }
    
    public function download($id)
    {
        $id=id_decode($id);
        $files = Files::where('id', $id)->firstOrFail();
       
        if($files)
        {
            $files->increment('download');
            
            activity('file')
                ->performedOn($files)
                ->causedBy(auth()->user())
                ->withProperties(['subject' => $files,'causer'=>auth()->user()])
                ->log('download');
            
            $headers = [
              'Content-Type' => $files->mime,
            ];
            $path=$files->path;
            $temp = tempnam(sys_get_temp_dir(), $files->filename);
            copy($path, $temp);
            return response()->download($temp, $files->filename, $headers);
        }else{
            return back();
        }
        
    }
    
    
    
    
    
    
    
}
