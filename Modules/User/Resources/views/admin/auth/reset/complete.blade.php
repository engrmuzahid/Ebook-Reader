@extends('user::admin.auth.layout')

@section('title', clean(trans('user::auth.reset_password')))

@section('content')
    <div class="container container-login">
        <h3 class="text-center">{{ clean(trans('user::auth.reset_password')) }}</h3>
        <form method="POST" class="login-form clearfix">
            {{ csrf_field() }}
            
            <div class="form-group {{ $errors->has('new_password') ? 'has-error': '' }}">
                <label for="password">{{ clean(trans('user::attributes.users.new_password')) }} <span class="required-label">*</span></label>
                <div class="position-relative">
                    <input type="password" name="new_password" class="form-control" id="password" autofocus>
                
                    <div class="show-password">
                        <i class="icon-eye"></i>
                    </div>
                </div>
                
                @if($errors->has('new_password'))
                    <span class="help-block error">{{ clean($errors->first('new_password')) }}</span>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('new_password_confirmation') ? 'has-error': '' }}">
                
                <label for="new_password_confirmation">{{ clean(trans('user::auth.password_confirmation')) }} <span class="required-label">*</span></label>
                
                <div class="position-relative">
                    <input type="password" class="form-control" name="new_password_confirmation" placeholder="{{ clean(trans('user::attributes.users.new_password_confirmation')) }}" id="new_password_confirmation">

                    <div class="show-password">
                        <i class="icon-eye"></i>
                    </div>
                </div>

                @if($errors->has('new_password_confirmation'))
                    <span class="help-block error">{{ clean($errors->first('new_password_confirmation')) }}</span>
                @endif
            </div>
            <div class="row form-action">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary col-md-12 fw-bold" data-loading>{{ clean(trans('user::auth.reset_password')) }}</button>
                </div>
            </div>
            
            
        </form>    
    </div>
    
@endsection
