<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    /**
     * Display the dashboard with its widgets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->has('table')) {
            
            $activity=Activity::when(auth()->user()->isUser(),function($query) {
                $query->where('causer_id', auth()->user()->id);
                $query->where('causer_type','Modules\User\Entities\User');
            })->get();
            return datatables($activity)
                ->editColumn('user', function ($entity) {
                    return $this->getActivityUser($entity,$for='causer');
                })
                ->editColumn('description', function ($entity) {
                    return $this->getActivityDescription($entity);
                })
                ->editColumn('created_at', function ($entity) {
                    return view('admin::include.table.date')->with('date', $entity->created_at);
                })
                ->rawColumns(['created_at'])
                ->make();
                
            
        }
        
        return view('admin::activity.index', []);
    }
    protected function getActivityUser($entity,$for='')
    {
        
        $properties=json_decode($entity->properties); 
        if(!empty($properties))
        {
            if(isset($properties->causer) && $for=='causer')
            {
                return $properties->causer->full_name;
            }
            
            if(isset($properties->subject) && $entity->log_name=='user')
            {
                return $properties->subject->full_name;
            }
            if(isset($properties->subject) && ($entity->log_name=='role' || $entity->log_name=='fileExtension' || $entity->log_name=='fileFolder'))
            {
                
                return $properties->subject->name;
            }
            if(isset($properties->subject) && $entity->log_name=='translation')
            {
                return $properties->subject->locale;
            }
            if(isset($properties->subject) && $entity->log_name=='file')
            {
                return $properties->subject->filename;
            }
            return ''; 
        }
        return '';
        
    } 
    protected function getActivityDescription($entity)
    {
        $dec=$entity->description;
        
        //user
        if($entity->log_name=='user' && $entity->description=='login'){
            return 'Logged in.';
        }
        if($entity->log_name=='user' && $entity->description=='register'){
            return 'New User Registered.';
        }
        if($entity->log_name=='user' && $entity->description=='created'){
            $name=$this->getActivityUser($entity,$for='subject');
            return 'Created a new user named - '.$name;
        }
        if($entity->log_name=='user' && $entity->description=='updated'){
            $name=$this->getActivityUser($entity,$for='subject');
            return 'Updated user information of - '.$name;
        }
        if($entity->log_name=='profile' && $entity->description=='updated'){
            return 'Updated Profile information';
        }
        if($entity->log_name=='user' && $entity->description=='deleted'){
            $name=$this->getActivityUser($entity,$for='subject');
            return 'Deleted user - '.$name;
        }
        
        //role
        if($entity->log_name=='role' && $entity->description=='created'){
            $name=$this->getActivityUser($entity,$for='subject');
            return 'Created a new role named - '.$name;
        }
        if($entity->log_name=='role' && $entity->description=='updated'){
            $name=$this->getActivityUser($entity,$for='subject');
            return 'Updated role information of - '.$name;
        }
        if($entity->log_name=='role' && $entity->description=='deleted'){
            $name=$this->getActivityUser($entity,$for='subject');
            return 'Deleted role - '.$name;
        }
        
        //translation
        if($entity->log_name=='translation' && $entity->description=='updated'){
            $locale=$this->getActivityUser($entity,$for='subject');
            return 'Updated translation information of - '.$locale;
        }
        
        //setting
        if($entity->log_name=='setting' && $entity->description=='updated'){
            return 'Updated setting';
        }
        
        //fileExtension
        if($entity->log_name=='fileExtension' && $entity->description=='created'){
            $name=$this->getActivityUser($entity,$for='subject');
            return 'Created a new file extension named - '.$name;
        }
        if($entity->log_name=='fileExtension' && $entity->description=='deleted'){
            $name=$this->getActivityUser($entity,$for='subject');
            return 'Deleted file extension - '.$name;
        }
        
        //fileFolder
        if($entity->log_name=='fileFolder' && $entity->description=='created'){
            $name=$this->getActivityUser($entity,$for='subject');
            return 'Created a new file folder named - '.$name;
        }
        if($entity->log_name=='fileFolder' && $entity->description=='deleted'){
            $name=$this->getActivityUser($entity,$for='subject');
            return 'Deleted file folder - '.$name;
        }
        
        //file
        if($entity->log_name=='file' && $entity->description=='created'){
            $name=$this->getActivityUser($entity,$for='subject');
            return 'Upload a new file named - '.$name;
        }
        if($entity->log_name=='file' && $entity->description=='deleted'){
            $name=$this->getActivityUser($entity,$for='subject');
            return 'Deleted file - '.$name;
        }
        if($entity->log_name=='file' && $entity->description=='download'){
            $name=$this->getActivityUser($entity,$for='subject');
            return 'Dwnload file - '.$name;
        }
        
        
        
    }
    
}
