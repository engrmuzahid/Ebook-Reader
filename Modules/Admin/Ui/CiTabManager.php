<?php

namespace Modules\Admin\Ui;

class CiTabManager
{
    /**
     * The array of all CiTabs.
     *
     * @var array
     */
    private $tabs = [];

    /**
     * The array of all ci tabs extenders.
     *
     * @var array
     */
    private $extends = [];

    /**
     * Register a new CiTabs.
     *
     * @param string $name
     * @param string $tabs
     * @return void
     */
    public function register($name, $tabs)
    {
        $this->tabs[$name] = $tabs;
    }

    /**
     * Add a new CiTabs extender.
     *
     * @param string $name
     * @param string $extender
     * @return void
     */
    public function extend($name, $extender)
    {
        $this->extends[$name][] = $extender;
    }

    /**
     * Get ci tabs for the given name.
     *
     * @param string $name
     * @return \Modules\Admin\Ui\CiTabs
     */
    public function get($name)
    {
        if (! array_key_exists($name, $this->tabs)) {
            return;
        }

        return tap(resolve($this->tabs[$name]), function (CiTabs $tabs) use ($name) {
            $tabs->make();

            $this->extendTabs($tabs, array_get($this->extends, $name, []));
        });
    }

    /**
     * Extend the given ci tabs using the given extenders.
     *
     * @param \Modules\Admin\Ui\CiTabs $tabs
     * @param array $extenders
     * @return void
     */
    private function extendTabs(CiTabs $tabs, array $extenders)
    {
        foreach ($extenders as $extender) {
            resolve($extender)->extend($tabs);
        }
    }
}
