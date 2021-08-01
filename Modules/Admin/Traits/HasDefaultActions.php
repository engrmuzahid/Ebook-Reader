<?php

namespace Modules\Admin\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Base\Search\Searchable;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Ui\Facades\TabManager;

trait HasDefaultActions
{
    /**
     * Get a new instance of the Current model.
     *
     * @return void
     */
    protected function getCurrentModel()
    {
        return new $this->model;
    }
    
    /**
     * Get Current name of the resource.
     *
     * @return string
     */
    protected function getCurrentResourceName()
    {
        if (isset($this->resourceName)) {
            return $this->resourceName;
        }

        return lcfirst(class_basename($this->model));
    }
    
    /**
     * Get Current form data for the given action.
     *
     * @param string $action
     * @param mixed ...$argument
     * @return array
     */
    protected function getCurrentFormData($action, ...$argument)
    {
        if (method_exists($this, 'formData')) {
            return  $this->formData(...$argument);
        }

        if (method_exists($this, 'createFormData')  && $action === 'create' ) {
            return $this->createFormData();
        }

        if (method_exists($this, 'editFormData') &&  $action === 'edit' ) {
            return $this->editFormData(...$argument);
        }

        return [];
    }
    
    /**
     * Disable search synchronize for the current entity.
     *
     * @return void
     */
    protected function disableSearchSyncing()
    {
        if ($this->is_searchable()) {
            $this->getCurrentModel()->disableSearchSyncing();
        }
    }

    /**
     * Determine if the current entity is searchable or not.
     *
     * @return bool
     */
    protected function is_searchable()
    {
        return in_array(Searchable::class, class_uses_recursive($this->getCurrentModel()));
    }

    /**
     * Make the given current model instance as searchable.
     *
     * @return void
     */
    protected function searchable($entity)
    {
        if ($this->is_searchable($entity)) {
            $entity->searchable();
        }
    }
    
     /**
     * Get route prefix of the current resource.
     *
     * @return string
     */
    protected function getCurrentRoutePrefix()
    {
        if (isset($this->routePrefix)) {
            return $this->routePrefix;
        }
        
        $table=$this->getCurrentModel()->getTable();
        
        return "admin.{$table}";
    }
    
    /**
     * Get label of the current resource.
     *
     * @return void
     */
    protected function getCurrentResourceLabel()
    {
        return trans($this->label);
    }
    
    /**
     * Get an entity by the given id.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function getEntity($id)
    {
        return $this->getCurrentModel()
            ->with($this->relations())
            ->withoutGlobalScope('active')
            ->findOrFail($id);
    }
    
    /**
     * Get the relations.
     *
     * @return array
     */
    private function relations()
    {
        return collect($this->with ?? [])->mapWithKeys(function ($relation) {
            return [$relation => function ($query) {
                return $query->withoutGlobalScope('active');
            }];
        })->all();
    }
    
    /**
     * Get request object Data
     *
     * @param string $action
     * @return \Illuminate\Http\Request
     */
    protected function getRequestData($action)
    {
        if (!isset($this->validation)) {
            //request()->merge(clean(request()->all()));
            return request();
        }

        if (isset($this->validation[$action])) {
            return resolve($this->validation[$action]);
        }

        return resolve($this->validation);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$request->merge(clean($request->all()));
        if ($request->has('query')) {
            return $this->getCurrentModel()
                ->search($request->get('query'))
                ->query()
                ->limit($request->get('limit', 10))
                ->get();
        }

        if ($request->has('table')) {
            return $this->getCurrentModel()->table($request);
        }
        
        $viewPath=$this->viewPath;
        
        return view("{$viewPath}.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tabs=TabManager::get($this->getCurrentModel()->getTable());
        $resourceName=$this->getCurrentResourceName();
        $model=$this->getCurrentModel();
        
        $data = array_merge(['tabs' =>$tabs, $resourceName =>$model], $this->getCurrentFormData('create'));
        
        $viewPath=$this->viewPath;
        
        return view("{$viewPath}.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->disableSearchSyncing();

        //$entity = $this->getCurrentModel()->create(clean($this->getRequestData('store')->all()));
        $entity = $this->getCurrentModel()->create($this->getRequestData('store')->all());

        $this->searchable($entity);
        
        $resourceName=$this->getCurrentResourceName();
        activity($resourceName)
            ->performedOn($entity)
            ->causedBy(auth()->user())
            ->withProperties(['subject' => $entity,'causer'=>auth()->user()])
            ->log('created');
        
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($entity);
        }
        
        $routePrefix=$this->getCurrentRoutePrefix();
        $resourceLabel=$this->getCurrentResourceLabel();
        
        return redirect()->route("{$routePrefix}.index")
            ->withSuccess(trans('admin::messages.saved_message', ['resource' =>$resourceLabel ]));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = $this->getEntity($id);
        $resourceName=$this->getCurrentResourceName();
        $viewPath=$this->viewPath;
        
        if (request()->wantsJson()) {
            return $entity;
        }

        return view("{$viewPath}.show")->with($resourceName, $entity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $tabs=TabManager::get($this->getCurrentModel()->getTable());
        $resourceName=$this->getCurrentResourceName();
        $entity = $this->getEntity($id);
        
        $viewPath=$this->viewPath;
        
        $data = array_merge(['tabs' => $tabs,$resourceName => $entity],$this->getCurrentFormData('edit', $id));

        return view("{$viewPath}.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $entity = $this->getEntity($id);

        $this->disableSearchSyncing();

       // $entity->update(clean($this->getRequestData('update')->all()));
        $entity->update($this->getRequestData('update')->all());

        $this->searchable($entity);
        
        $resourceName=$this->getCurrentResourceName();
        activity($resourceName)
            ->performedOn($entity)
            ->causedBy(auth()->user())
            ->withProperties(['subject' => $entity,'causer'=>auth()->user()])
            ->log('updated');
        
        $resourceLabel=$this->getCurrentResourceLabel();
        $routePrefix=$this->getCurrentRoutePrefix();
        
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($entity)
                ->withSuccess(trans('admin::messages.update_message', ['resource' => $resourceLabel]));
        }

        return redirect()->route("{$routePrefix}.index")
            ->withSuccess(trans('admin::messages.update_message', ['resource' => $resourceLabel]));
    }

    /**
     * Destroy resources by given ids.
     *
     * @param string $ids
     * @return void
     */
    public function destroy($ids)
    {
        $delete_id=explode(',', $ids);
        $resourceName=$this->getCurrentResourceName();
        foreach($delete_id as $id)
        {
            //$entity=$this->getCurrentModel()->findById($id);
            $entity=$this->getEntity($id);
            activity($resourceName)
                ->performedOn($entity)
                ->causedBy(auth()->user())
                ->withProperties(['subject' => $entity,'causer'=>auth()->user()])
                ->log('deleted');
        }
        $this->getCurrentModel()
            ->withoutGlobalScope('active')
            ->whereIn('id', explode(',', $ids))
            ->delete();
    }

}
