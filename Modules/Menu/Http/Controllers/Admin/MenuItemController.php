<?php

namespace Modules\Menu\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\MenuItem;
use Modules\Menu\Http\Requests\SaveMenuItemRequest;

class MenuItemController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param int $menuId
     * @return \Illuminate\Http\Response
     */
    public function create($menuId)
    {
        $menuItem = new MenuItem;
        $tabs = TabManager::get('menu_items');

        return view('menu::admin.menu_items.create', compact('menuId', 'menuItem', 'tabs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $menuId
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($menuId, SaveMenuItemRequest $request)
    {
        $requestData=$request->all();
        if(isset($requestData['parent_id']) && empty($requestData['parent_id'])){
            $requestData['parent_id']=null;
        }
        if(isset($requestData['category_id']) && empty($requestData['category_id'])){
            $requestData['category_id']=null;
        }
        if(isset($requestData['page_id']) && empty($requestData['page_id'])){
            $requestData['page_id']=null;
        }
        
        $menuItem = MenuItem::create(
            $this->prepare($menuId, $requestData)
        );

        return redirect()->route('admin.menus.edit', $menuId)
            ->withSuccess(clean(trans('admin::messages.saved_message', ['resource' => trans('menu::menu_items.menu_item')])));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $menuId
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($menuId, $id)
    {
        $menuItem = MenuItem::withoutGlobalScope('active')->findOrFail($id);
        $tabs = TabManager::get('menu_items');

        return view('menu::admin.menu_items.edit', compact('menuId', 'menuItem', 'tabs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $menuId
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($menuId, $id, SaveMenuItemRequest $request)
    {
        $requestData=$request->all();
        if(isset($requestData['parent_id']) && empty($requestData['parent_id'])){
            $requestData['parent_id']=null;
        }
        if(isset($requestData['category_id']) && empty($requestData['category_id'])){
            $requestData['category_id']=null;
        }
        if(isset($requestData['page_id']) && empty($requestData['page_id'])){
            $requestData['page_id']=null;
        }
        $menuItem = MenuItem::withoutGlobalScope('active')
            ->findOrFail($id)
            ->update(
                $this->prepare($menuId, $requestData)
            );

        return redirect()->route('admin.menus.edit', $menuId)
            ->withSuccess(clean(trans('admin::messages.update_message', ['resource' => trans('menu::menu_items.menu_item')])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        MenuItem::withoutGlobalScope('active')->findOrFail($id)->delete();
    }

    /**
     * Prepare menu item attributes for saving.
     *
     * @param int $menuId
     * @param array $attributes
     * @return array
     */
    private function prepare($menuId, array $attributes)
    {
        if (is_null($attributes['parent_id'])) {
            $attributes['parent_id'] = $this->parentId($menuId);
        }

        return array_merge($attributes, ['menu_id' => $menuId]);
    }

    /**
     * Get parent id for the given menu id.
     *
     * @param string string
     * @return int
     */
    private function parentId($menuId)
    {
        return MenuItem::withoutGlobalScope('not_root')
            ->where('menu_id', $menuId)
            ->value('id');
    }
}
