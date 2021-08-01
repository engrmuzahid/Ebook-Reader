@extends('user::admin.auth.layout')

@section('title', clean(trans('user::auth.sign_up')))

@section('content')
    <div class="container container-signup">
        @include('admin::include.notification')
        <h3 class="text-center">{{ clean(trans('user::auth.sign_up')) }}</h3>
        <div class="login-form">
            <form method="POST" action="{{ route('admin.register.post') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('first_name') ? 'has-error': '' }}">
                            <label for="first-name">{{ clean(trans('user::auth.first_name')) }} <span class="required-label">*</span></label>

                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" id="first-name" autofocus>
                            @if($errors->has('first_name'))
                                <span class="help-block error">{{ clean($errors->first('first_name')) }}</span>
                            @endif
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('last_name') ? 'has-error': '' }}">
                            <label for="last-name">{{ clean(trans('user::auth.last_name')) }} <span class="required-label">*</span></label>

                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" id="last-name">

                            @if($errors->has('last_name'))
                                <span class="help-block error">{{ clean($errors->first('last_name')) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                            <label for="email">{{ clean(trans('user::auth.email')) }} <span class="required-label">*</span></label>

                            <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="email">

                            @if($errors->has('email'))
                                <span class="help-block error">{{ clean($errors->first('email')) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('password') ? 'has-error': '' }}">
                            <label for="password">{{ clean(trans('user::auth.password')) }} <span class="required-label">*</span></label>
                            <div class="position-relative">
                                <input type="password" name="password" class="form-control" id="password">
                            
                                <div class="show-password">
                                    <i class="icon-eye"></i>
                                </div>
                            </div>
                            
                            @if($errors->has('password'))
                                <span class="help-block error">{{ clean($errors->first('password')) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error': '' }}">
                            <label for="confirm-password">{{ clean(trans('user::auth.password_confirmation')) }} <span class="required-label">*</span></label>
                            <div class="position-relative">
                                <input type="password" name="password_confirmation" class="form-control" id="confirm-password">
                                
                                <div class="show-password">
                                    <i class="icon-eye"></i>
                                </div>
                            </div>
                            
                            @if($errors->has('password_confirmation'))
                                <span class="help-block error">{{ clean($errors->first('password_confirmation')) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row form-action">
					<div class="col-md-4">
						<a href="{{ route('admin.login')  }}" id="show-signin" class="btn btn-danger btn-link w-100 fw-bold">{{ clean(trans('user::auth.cancel')) }}</a>
					</div>
					<div class="col-md-8">
						<button type="submit" class="btn btn-primary float-right mt-3 mt-sm-0 fw-bold" data-loading>{{ clean(trans('user::auth.sign_up')) }}</button>
					</div>
				</div>
                
                
            </form>
        </div>
        
    </div>
@endsection
