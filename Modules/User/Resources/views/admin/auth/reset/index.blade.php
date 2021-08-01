@extends('user::admin.auth.layout')

@section('title', clean(trans('user::auth.reset_password')))

@section('content')
    <div class="container container-login">
        @include('admin::include.notification')
        <h3 class="text-center">{{ clean(trans('user::auth.reset_password')) }}</h3>
        <p class="text-center">{{ clean(trans('user::auth.enter_email')) }}</p>
        
        <form method="POST" action="{{ route('admin.reset.post') }}">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                
                <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="{{ clean(trans('user::attributes.users.email')) }}" autofocus>
                @if($errors->has('email'))
                    <span class="help-block error">{{ clean($errors->first('email')) }}</span>
                @endif
            </div>
            
            <div class="row form-action">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary col-md-12 fw-bold" data-loading>{{ clean(trans('user::auth.reset_password')) }}</button>
                </div>
            </div>
            <div class="login-account">
                <span class="msg">{{ clean(trans('user::auth.i_remembered_my_password')) }}</span>
                <a href="{{ route('admin.login')  }}" id="show-signup" class="link">{{ clean(trans('user::auth.sign_in')) }}</a>
            </div>
        </form>
    </div>    
@endsection
