<?php

namespace Modules\Menu\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Admin\Traits\HasDefaultActions;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Http\Requests\SaveMenuRequest;

class MenuController extends Controller
{
    use HasDefaultActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'menu::menus.menu';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'menu::admin.menus';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveMenuRequest::class;

    /**
     * Redirect to url after saving a resource.
     *
     * @param \Modules\Menu\Entities\Menu $menu
     * @return \Illuminate\Http\Response
     */
    protected function redirectTo($menu)
    {
        return redirect()->route('admin.menus.edit', $menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
}
