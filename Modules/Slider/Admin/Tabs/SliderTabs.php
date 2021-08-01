<?php

namespace Modules\Slider\Admin\Tabs;

use Modules\Admin\Ui\CiTab;
use Modules\Admin\Ui\CiTabs;

class SliderTabs extends CiTabs
{
    /**
     * Indicate that submit button should render.
     *
     * @var bool
     */
    protected $buttonOffset = false;

    /**
     * Make new tabs with groups.
     *
     * @return void
     */
    public function make()
    {
        $this->group('slider_information', clean(trans('slider::sliders.tabs.group.slider_information')))
            ->active()
            ->add($this->slides())
            ->add($this->settings());
    }

    private function slides()
    {
        return tap(new CiTab('slides', clean(trans('slider::sliders.tabs.slides'))), function (CiTab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->view('slider::admin.sliders.tabs.slides');
        });
    }

    private function settings()
    {
        return tap(new CiTab('settings', clean(trans('slider::sliders.tabs.settings'))), function (CiTab $tab) {
            $tab->weight(10);
            $tab->fields(['name']);
            $tab->view('slider::admin.sliders.tabs.settings');
        });
    }
}
