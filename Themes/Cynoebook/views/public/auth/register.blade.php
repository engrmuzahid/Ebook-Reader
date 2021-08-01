@extends('public.layout')

@section('title', clean(trans('user::auth.sign_up')))

@section('content')
    <div class="register-wrapper clearfix">
        <div class="col-lg-6 col-md-7 col-sm-10">
            <div class="row">
                @include('public.include.notification')
                <div class="form form-page no-lp-form-control form-overlay-layer">
                <div class="top-overlay"></div>
                <form method="POST" action="{{ route('register.post') }}">
                    {{ csrf_field() }}

                        <div class="form-inner clearfix">
                        
                            <h3>{{ clean(trans('user::auth.sign_up')) }}</h3>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('first_name') ? 'has-error': '' }}">
                                        <label for="first-name">{{ clean(trans('user::auth.first_name')) }}<span>*</span></label>

                                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" id="first-name" autofocus>

                                        @if($errors->has('first_name'))
                                            <span class="error-message">{{ clean($errors->first('first_name')) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('last_name') ? 'has-error': '' }}">
                                        <label for="last-name">{{ clean(trans('user::auth.last_name')) }}<span>*</span></label>

                                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" id="last-name">

                                        @if($errors->has('last_name'))
                                            <span class="error-message">{{ clean($errors->first('last_name')) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">    
                                    <div class="form-group {{ $errors->has('username') ? 'has-error': '' }}">
                                        <label for="username">{{ clean(trans('user::auth.username')) }}<span>*</span></label>

                                        <input type="text" name="username" value="{{ old('username') }}" class="form-control" id="username">

                                        @if($errors->has('username'))
                                            <span class="error-message">{{ clean($errors->first('username')) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                                        <label for="email">{{ clean(trans('user::auth.email')) }}<span>*</span></label>

                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="email">

                                        @if($errors->has('email'))
                                            <span class="error-message">{{ clean($errors->first('email')) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('password') ? 'has-error': '' }}">
                                        <label for="password">{{ clean(trans('user::auth.password')) }}<span>*</span></label>

                                        <input type="password" name="password" class="form-control" id="password">

                                        @if($errors->has('password'))
                                            <span class="error-message">{{ clean($errors->first('password')) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error': '' }}">
                                        <label for="confirm-password">{{ clean(trans('user::auth.password_confirmation')) }}<span>*</span></label>

                                        <input type="password" name="password_confirmation" class="form-control" id="confirm-password">

                                        @if($errors->has('password_confirmation'))
                                            <span class="error-message">{{ clean($errors->first('password_confirmation')) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="form-group {{ $errors->has('captcha') ? 'has-error': '' }}">
                                    @captcha
                                    <input type="text" name="captcha" id="captcha" class="captcha-input">

                                    @if($errors->has('captcha'))
                                        <span class="error-message">{{ clean($errors->first('captcha')) }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <input type="checkbox" name="privacy_policy" id="privacy">

                                    <label for="privacy">
                                        {{ clean(trans('user::auth.i_agree_to_the')) }} <a href="{{ $privacyPageURL }}">{{ clean(trans('user::auth.privacy_policy')) }}</a>
                                    </label>

                                    @if($errors->has('privacy_policy'))
                                        <span class="error-message">{{ clean($errors->first('privacy_policy')) }}</span>
                                    @endif
                                </div>
                                <div class="login-account pull-left p-t-15">
                                    <span class="msg">{{ clean(trans('user::auth.already_have_account')) }}</span>
                                    <a href="{{ route('login')  }}" id="show-signup" class="link">{{ clean(trans('user::auth.sign_in')) }}</a>
                                </div>
                                <button type="submit" class="btn btn-primary btn-register pull-right" data-loading>
                                    {{ clean(trans('user::auth.sign_up')) }}
                                </button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
