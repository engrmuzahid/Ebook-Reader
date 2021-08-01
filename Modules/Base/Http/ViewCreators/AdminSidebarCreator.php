<?php

namespace Modules\Base\Http\ViewCreators;

use Illuminate\View\View;
use Modules\Base\Sidebar\AdminSidebar;
use Maatwebsite\Sidebar\Presentation\SidebarRenderer;

class AdminSidebarCreator
{
    /**
     * @var \Modules\Base\Sidebar\AdminSidebar
     */
    protected $sidebar;

    /**
     * @var \Maatwebsite\Sidebar\Presentation\SidebarRenderer
     */
    protected $renderer;

    /**
     * @param \Modules\Base\Sidebar\AdminSidebar $sidebar
     * @param \Maatwebsite\Sidebar\Presentation\SidebarRenderer $renderer
     */
    public function __construct(AdminSidebar $sidebar, SidebarRenderer $renderer)
    {
        $this->sidebar = $sidebar;
        $this->renderer = $renderer;
    }

    public function create(View $view)
    {
        $view->sidebar = $this->renderer->render($this->sidebar);
    }
}
