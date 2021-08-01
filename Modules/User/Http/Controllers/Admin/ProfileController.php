<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\User\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $tabs = TabManager::get('profile');

        return view('user::admin.profile.edit', compact('tabs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Modules\User\Http\Requests\UpdateProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        //$request->merge(clean($request->all()));
        $this->bcryptPassword($request);

        auth()->user()->update($request->all());
        
        activity('profile')
            ->performedOn(auth()->user())
            ->causedBy(auth()->user())
            ->withProperties(['subject' => auth()->user(),'causer'=>auth()->user()])
            ->log('updated');
        
        return back()->withSuccess(clean(trans('admin::messages.update_message', [
            'resource' => trans('user::users.profile'),
        ])));
    }

    /**
     * Bcrypt user password.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function bcryptPassword($request)
    {
        if ($request->filled('password')) {
            return $request->merge(['password' => bcrypt($request->password)]);
        }

        unset($request['password']);
    }
}
