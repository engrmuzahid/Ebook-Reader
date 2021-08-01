<?php

namespace Modules\Base\Sidebar;

use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Sidebar;
use Nwidart\Modules\Facades\Module;
use Nwidart\Modules\Contracts\RepositoryInterface as Modules;

class AdminSidebar implements Sidebar
{
    protected $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function getMenu()
    {
        $this->build();

        return $this->menu;
    }

    public function build()
    {
        $this->addThemeExtender();
        $this->addModuleExtenders();
    }

    /**
     * Add active theme's sidebar extender.
     *
     * @return void
     */
    private function addThemeExtender()
    {
        $theme = setting('active_theme');
        $extender="Themes\\{$theme}\\Sidebar\\SidebarExtender";
        $this->add($extender);
    }

    /**
     * Add all enabled modules sidebar extender.
     *
     * @return void
     */
    private function addModuleExtenders()
    {
        $modules=Module::allEnabled();
        
        foreach ($modules as $module) {
            $extender="Modules\\{$module->getName()}\\Sidebar\\SidebarExtender";
            $this->add($extender);
        }
        
    }

    /**
     * Add sidebar extender to the menu.
     *
     * @param string $extender
     * @return void
     */
    private function add($extender)
    {
        if (class_exists($extender)) {
            resolve($extender)->extend($this->menu);
        }

        $this->menu->add($this->menu);
    }

    
}
