<?php

namespace Modules\Setting\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\Setting\Http\Requests\UpdateSettingRequest;


class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit()
    {
        //$settings = clean(setting()->all());
        $settings = setting()->all();
        /* if(isset($settings['googleanalyticscode']))
        {
            $settings['googleanalyticscode']=setting()->get('googleanalyticscode');
        }
        if(isset($settings['custom_js']))
        {
            $settings['custom_js']=setting()->get('custom_js');
        } */
        
        $tabs = TabManager::get('settings');

        return view('setting::admin.settings.edit', compact('settings', 'tabs'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateSettingRequest $request)
    {
        
        //setting(clean($request->except('_token', '_method','googleanalyticscode','custom_js')));
        setting($request->except('_token', '_method','googleanalyticscode','custom_js'));
        if ($request->has('googleanalyticscode')|| $request->has('custom_js')) {
            setting($request->only('googleanalyticscode', 'custom_js'));
        } 
        activity('setting')
            ->causedBy(auth()->user())
            ->withProperties(['subject' => auth()->user(),'causer'=>auth()->user()])
            ->log('updated');
        
        $this->handleMaintenanceMode($request);

        return redirect(non_localized_url())
            ->with('success', clean(trans('setting::messages.settings_have_been_saved')));
        
    }

    private function handleMaintenanceMode($request)
    {
        if ($request->maintenance_mode) {
            Artisan::call('down', [
                '--allow' => $this->allowedIps($request),
            ]);
        } elseif (app()->isDownForMaintenance()) {
            Artisan::call('up');
        }
    }

    private function allowedIps($request)
    {
        $ips = explode(PHP_EOL, $request->allowed_ips);

        return array_map(function ($ip) {
            return trim($ip, "\r\n");
        }, $ips);
    }
    
    public function cacheClear() 
    {
        Artisan::call('config:clear');
        Artisan::call('route:trans:clear');
        return back()->withSuccess(clean(trans('setting::messages.cache_cleaned_successfully')));
    }
}
