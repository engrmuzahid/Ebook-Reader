<?php

namespace Modules\User\Http\Controllers\Admin;

use Modules\User\Http\Controllers\BaseAuthController;

class AuthController extends BaseAuthController
{
    /**
     * Where to redirect users after login..
     *
     * @return string
     */
    protected function redirectToUrl()
    {
        return route('admin.dashboard.index');
    }

    /**
     * The login URL.
     *
     * @return string
     */
    protected function loginRoute()
    {
        return route('admin.login');
    }

    /**
     * Show login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLoginView()
    {
        return view('user::admin.auth.login');
    }
    
    /**
     * Show reset password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getResetView()
    {
        return view('user::admin.auth.reset.index');
    }

    /**
     * Reset complete form route.
     *
     * @param \Modules\User\Entities\User $user
     * @param string $code
     * @return string
     */
    protected function resetCompleteRoute($user, $code)
    {
        return route('admin.reset.complete', [$user->email, $code]);
    }

    /**
     * Password reset complete view.
     *
     * @return string
     */
    protected function resetCompleteView()
    {
        return view('user::admin.auth.reset.complete');
    }
}
