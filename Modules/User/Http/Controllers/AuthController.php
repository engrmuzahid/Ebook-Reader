<?php

namespace Modules\User\Http\Controllers;

use Exception;
use Modules\Page\Entities\Page;
use Modules\User\Entities\User;
use Laravel\Socialite\Facades\Socialite;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;

class AuthController extends BaseAuthController
{
    /**
     * Where to redirect users after login..
     *
     * @return string
     */
    protected function redirectToUrl()
    {
        return route('account.dashboard.index');
    }

    /**
     * The login URL.
     *
     * @return string
     */
    protected function loginRoute()
    {
        return route('login');
    }

    /**
     * Show login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLoginView()
    {
        return view('public.auth.login');
    }

    /**
     * Redirect the user to the given provider authentication page.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        if (! in_array($provider, app('enabled_social_login_providers'))) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the given provider.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        if (! in_array($provider, app('enabled_social_login_providers'))) {
            abort(404);
        }

        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect()->route('login');
        }
        
        if (User::registered($user->getEmail())) {
            try {
                 $this->auth->login(
                    User::findByEmail($user->getEmail())
                ); 
                return redirect($this->redirectToUrl());
            } catch (NotActivatedException $e) {
                return redirect()->route('login')
                    ->withError(clean(trans('user::messages.users.account_not_activated')));
            } 

            
        }
        if(!setting('enable_registrations'))
        {
              return redirect()->route('login')->withError(trans('user::messages.users.invalid_credentials'));
        }
        [$firstName, $lastName] = $this->extractName($user->getName());
        
        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' =>$firstName.str_random(),
            'email' => $user->getEmail(),
            'password' => str_random(),
        ];
        
        
        if (setting('auto_approve_user')) {
            $registeredUser = $this->auth->registerAndActivate($data);
        
        }else{
            $registeredUser = $this->auth->register($data);
        }
        $this->assignUserRole($registeredUser);
        
        if (setting('auto_approve_user')) {
            auth()->login($registeredUser);
            return redirect($this->redirectToUrl());
        }else{
            return redirect($this->loginRoute())
                ->withSuccess(clean(trans('user::messages.users.account_created_but_need_admin_review')));
        }
    }

    private function extractName($name)
    {
        return explode(' ', $name, 2);
    }

    /**
     * Show registrations form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegisterView()
    {
        if(!setting('enable_registrations'))
        {
              return redirect()->route('login');
        }
        
        $privacyPageURL = Page::urlForPage(setting('cynoebook_privacy_page'));

        return view('public.auth.register', compact('privacyPageURL'));
    }

    /**
     * Show reset password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getResetView()
    {
        return view('public.auth.reset.begin');
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
        return route('reset.complete', [$user->email, $code]);
    }

    /**
     * Password reset complete view.
     *
     * @return string
     */
    protected function resetCompleteView()
    {
        return view('public.auth.reset.complete');
    }
}
