<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\User\Contracts\Authentication;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Mail;
use Modules\User\Emails\Welcome;
use Modules\User\Emails\ResetPasswordEmail;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Http\Requests\RegisterRequest;
use Modules\User\Http\Requests\PasswordResetRequest;
use Modules\User\Http\Requests\ResetCompleteRequest;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;

abstract class BaseAuthController extends Controller
{
    /**
     * The Authentication instance.
     *
     * @var \Modules\User\Contracts\Authentication
     */
    protected $auth;

    /**
     * @param \Modules\User\Contracts\Authentication $auth
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;

        $this->middleware('guest')->except('getLogout');
    }

    /**
     * Where to redirect users after login..
     *
     * @return string
     */
    abstract protected function redirectToUrl();

    /**
     * The login route.
     *
     * @return string
     */
    abstract protected function loginRoute();

    /**
     * Show login form.
     *
     * @return \Illuminate\Http\Response
     */
    abstract public function getLoginView();

    /**
     * Show reset password form.
     *
     * @return \Illuminate\Http\Response
     */
    abstract public function getResetView();
    
    /**
     * Reset complete form route.
     *
     * @param \Modules\User\Entities\User $user
     * @param string $code
     * @return string
     */
    abstract protected function resetCompleteRoute($user, $code);

    /**
     * Password reset complete view.
     *
     * @return string
     */
    abstract protected function resetCompleteView();
    
    /**
     * Login a user.
     *
     * @param \Modules\User\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(LoginRequest $request)
    {
        //$request->merge(clean($request->all()));
        try {
            $loggedIn = $this->auth->login([
                'email' => $request->email,
                'password' => $request->password,
            ], (bool) $request->get('remember_me', false));

            if (! $loggedIn) {
                return back()->withInput()
                    ->withError(clean(trans('user::messages.users.invalid_credentials')));
            }
            
            activity('user')
                ->performedOn($loggedIn)
                ->causedBy($loggedIn)
                ->withProperties(['subject' => $loggedIn,'causer'=>$loggedIn])
                ->log('login');
            
            return redirect()->intended($this->redirectToUrl());
            
        } catch (NotActivatedException $e) {
            return back()->withInput()
                ->withError(clean(trans('user::messages.users.account_not_activated')));
        } catch (ThrottlingException $e) {
            return back()->withInput()
                ->withError(clean(trans('user::messages.users.account_is_blocked', ['delay' => intl_number($e->getDelay())])));
        }
    }

    /**
     * Logout current user.
     *
     * @return void
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect($this->loginRoute());
    }

    /**
     * Register a user.
     *
     * @param \Modules\User\Http\Requests\RegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(RegisterRequest $request)
    {
        //$request->merge(clean($request->all()));
        $data=$request->only([
            'first_name',
            'last_name',
            'username',
            'email',
            'password',
        ]);
        
        
        if (setting('auto_approve_user')) {
            $user = $this->auth->registerAndActivate($data);
        }else{
            $user = $this->auth->register($data);
        }
        
        $this->assignUserRole($user);

        if (setting('welcome_email')) {
            try{
                Mail::to($request->email)
                    ->send(new Welcome($request->first_name));
            }catch(\Exception $e)
            {
               
            }
        }
        
        activity('user')
                ->performedOn($user)
                ->causedBy($user)
                ->withProperties(['subject' => $user,'causer'=>$user])
                ->log('register');
        
        return redirect($this->loginRoute())
            ->withSuccess(clean(trans('user::messages.users.account_created')));
    }

    protected function assignUserRole($user)
    {
        $role = Role::findOrNew(setting('user_role'));

        if ($role->exists) {
            $this->auth->assignRole($user, $role);
        }
    }

    /**
     * Start the reset password process.
     *
     * @param \Modules\User\Http\Requests\PasswordResetRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(PasswordResetRequest $request)
    {
        //$request->merge(clean($request->all()));
        $user = User::where('email', $request->email)->first();

        if (is_null($user)) {
            return back()->withInput()
                ->withError(clean(trans('user::messages.users.no_user_found')));
        }

        $code = $this->auth->createReminderCode($user);

        Mail::to($user)
            ->send(new ResetPasswordEmail($user, $this->resetCompleteRoute($user, $code)));

        return back()->withSuccess(clean(trans('user::messages.users.check_email_to_reset_password')));
    }

    /**
     * Show reset password complete form.
     *
     * @param string $email
     * @param string $code
     * @return \Illuminate\Http\Response
     */
    public function getResetComplete($email, $code)
    {
        $user = User::where('email', $email)->firstOrFail();

        if ($this->invalidResetCode($user, $code)) {
            return redirect()->route('reset')
                ->withError(trans('user::messages.users.invalid_reset_code'));
        }

        return $this->resetCompleteView()->with(compact('user', 'code'));
    }

    /**
     * Determine the given reset code is invalid.
     *
     * @param \Modules\User\Entities\User $user
     * @param string $code
     * @return bool
     */
    private function invalidResetCode($user, $code)
    {
        return $user->reminders()->where('code', $code)->doesntExist();
    }

    /**
     * Complete the reset password process.
     *
     * @param string $email
     * @param string $code
     * @param \Modules\User\Http\Requests\ResetCompleteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postResetComplete($email, $code, ResetCompleteRequest $request)
    {
        //$request->merge(clean($request->all()));
        $user = User::where('email', $email)->firstOrFail();

        $completed = $this->auth->completeResetPassword($user, $code, $request->new_password);

        if (! $completed) {
            return back()->withInput()
                ->withError(clean(trans('user::messages.users.invalid_reset_code')));
        }

        return redirect($this->loginRoute())
            ->withSuccess(clean(trans('user::messages.users.password_has_been_reset')));
    }
}
