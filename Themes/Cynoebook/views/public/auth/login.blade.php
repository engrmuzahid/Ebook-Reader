@extends('public.layout')

@section('title', clean(trans('user::auth.sign_in')))

@section('content')
    <div class="form-wrapper">
        @include('public.include.notification')

        <div class="form form-page form-overlay-layer">
            <div class="top-overlay"></div>
            <form method="POST" action="{{ route('login.post') }}" class="login-form clearfix">
                {{ csrf_field() }}

                <div class="login form-inner clearfix">
                    

                    <h3>{{ clean(trans('user::auth.sign_in')) }}</h3>

                    <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                        <label for="email">{{ clean(trans('user::auth.email')) }}<span>*</span></label>

                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="{{ clean(trans('user::attributes.users.email')) }}" autofocus>

                        <div class="input-icon">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        </div>

                        @if($errors->has('email'))
                            <span class="error-message">{{ clean($errors->first('email')) }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('password') ? 'has-error': '' }}">
                        <label for="password">{{ clean(trans('user::auth.password')) }}<span>*</span></label>

                        <input type="password" name="password" class="form-control" id="password" placeholder="{{ clean(trans('user::attributes.users.password')) }}">

                        <div class="input-icon">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </div>

                        @if($errors->has('password'))
                            <span class="error-message">{{ clean($errors->first('password')) }}</span>
                        @endif
                    </div>

                    <div class="clearfix"></div>

                    <button type="submit" class="btn btn-primary btn-center btn-login" data-loading>
                        {{ clean(trans('user::auth.sign_in')) }}
                    </button>

                    <div class="checkbox pull-left">
                        <input type="hidden" value="0">
                        <input type="checkbox" value="1" id="remember">

                        <label for="remember">{{ clean(trans('user::auth.remember_me')) }}</label>
                    </div>

                    <a href="{{ route('reset') }}" class="forgot-password pull-right">
                        {{ clean(trans('user::auth.forgot_password')) }}
                    </a>
                    <div class="clearfix"></div>
                    @if(setting('enable_registrations'))
                    <div class="login-account text-center">
                        <span class="msg">{{ clean(trans('user::auth.dont_have_an_account_yet')) }}</span>
                        <a href="{{ route('register')  }}" id="show-signup" class="link">{{ clean(trans('user::auth.sign_up')) }}</a>
                    </div>
                    @endif
                    <div class="clearfix"></div> 
                    <div class="social-login-buttons text-center">
                        @if (count(app('enabled_social_login_providers')) !== 0)
                            <div class="hline btn-primary">
                                <span class="hline-innertext btn-primary">{{ clean(trans('user::auth.or')) }}</span>
                            </div>
                            
                        @endif

                        @if (setting('facebook_login_enabled'))
                            <a href="{{ route('login.redirect', ['provider' => 'facebook']) }}" class="btn btn-facebook">
                                <i class="fa fa-facebook fa-fw"></i>
                                {{ clean(trans('user::auth.log_in_with_facebook')) }}
                            </a>
                        @endif

                        @if (setting('google_login_enabled'))
                            <a href="{{ route('login.redirect', ['provider' => 'google']) }}" class="btn btn-google">
                                <i class="fa fa-google fa-fw"></i>
                                {{ clean(trans('user::auth.log_in_with_google')) }}
                            </a>
                        @endif
                    </div>
        
                </div>
            </form>
        </div>
        
    </div>
@endsection
