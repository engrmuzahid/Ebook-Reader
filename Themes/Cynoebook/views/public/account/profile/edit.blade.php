@extends('public.account.layout')

@section('title', clean(trans('cynoebook::account.links.edit_profile')))

@section('account_breadcrumb')
    <li class="active">{{ clean(trans('cynoebook::account.links.edit_profile')) }}</li>
@endsection

@section('content_right')
    <form method="POST" action="{{ route('account.profile.update') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}

        <div class="account-details">
            <div class="account clearfix">
                <h4>{{ clean(trans('cynoebook::account.profile.edit_profile')) }}</h4>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('first_name') ? 'has-error': '' }}">
                            <label for="first-name">
                                {{ clean(trans('cynoebook::account.profile.first_name')) }}<span>*</span>
                            </label>

                            <input type="text" name="first_name" id="first-name" class="form-control" value="{{ old('first_name', $my->first_name) }}">
                            @if($errors->has('first_name'))
                                <span class="error-message">{{ clean($errors->first('first_name')) }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('last_name') ? 'has-error': '' }}">
                            <label for="last-name">
                                {{ clean(trans('cynoebook::account.profile.last_name')) }}<span>*</span>
                            </label>

                            <input type="text" name="last_name" id="last-name" class="form-control" value="{{ old('last_name', $my->last_name) }}">
                            @if($errors->has('last_name'))
                                <span class="error-message">{{ clean($errors->first('last_name')) }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('username') ? 'has-error': '' }}">
                            <label for="">
                                {{ clean(trans('cynoebook::account.profile.user_name')) }}<span>*</span>
                            </label>

                            <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $my->username) }}">
                            @if($errors->has('username'))
                                <span class="error-message">{{ clean($errors->first('username')) }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                            <label for="">
                                {{ clean(trans('cynoebook::account.profile.email')) }}<span>*</span>
                            </label>

                            <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $my->email) }}">

                            @if($errors->has('email'))
                                <span class="error-message">{{ clean($errors->first('email')) }}</span>
                            @endif
                            
                        </div>
                        
                        <div class="form-group {{ $errors->has('about') ? 'has-error': '' }}">
                            <label for="">
                                {{ clean(trans('cynoebook::account.profile.about')) }}
                            </label>

                            <textarea name="about" id="about" class="form-control" rows="10">{{ old('about', $my->about) }}</textarea>

                            @if($errors->has('about'))
                                <span class="error-message">{{ clean($errors->first('about')) }}</span>
                            @endif
                            
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class=" row no-gutters form-group {{ $errors->has('avatar') ? 'has-error': '' }}">
                            <div class="col-md-9 col-sm-12 ">
                                <label for="first-name">
                                    {{ clean(trans('cynoebook::account.profile.avatar')) }}
                                </label>

                                <input type="file" name="avatar" id="avatar" class="form-control">

                                @if($errors->has('avatar'))
                                    <span class="error-message">{{ clean($errors->first('avatar')) }}</span>
                                @endif
                                
                            </div>    
                            <div class="col-md-3 col-sm-12">    
                                @if (! $my->avatar->exists)
                                    <div class="image-placeholder">
                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                    </div>
                                @else
                                    <div class="image-placeholder">
                                        <img src="{{ $my->avatar->path }}"  width="75" height="75">
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('facebook') ? 'has-error': '' }}">
                            <label for="first-name">
                                {{ clean(trans('cynoebook::account.profile.facebook')) }}
                            </label>

                            <input type="text" name="facebook" id="facebook" class="form-control" value="{{ old('facebook', $my->facebook) }}">

                            @if($errors->has('facebook'))
                                <span class="error-message">{{ clean($errors->first('facebook')) }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('twitter') ? 'has-error': '' }}">
                            <label for="last-name">
                                {{ clean(trans('cynoebook::account.profile.twitter')) }}
                            </label>

                            <input type="text" name="twitter" id="twitter" class="form-control" value="{{ old('twitter', $my->twitter) }}">

                            @if($errors->has('twitter'))
                                <span class="error-message">{{ clean($errors->first('twitter')) }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('google') ? 'has-error': '' }}">
                            <label for="">
                                {{ clean(trans('cynoebook::account.profile.google')) }}
                            </label>

                            <input type="text" name="google" id="google" class="form-control" value="{{ old('google', $my->google) }}">

                            @if($errors->has('google'))
                                <span class="error-message">{{ clean($errors->first('google')) }}</span>
                            @endif
                            
                        </div>
                        
                        <div class="form-group {{ $errors->has('instagram') ? 'has-error': '' }}">
                            <label for="">
                                {{ clean(trans('cynoebook::account.profile.instagram')) }}
                            </label>

                            <input type="text" name="instagram" id="instagram" class="form-control" value="{{ old('instagram', $my->instagram) }}">

                            @if($errors->has('instagram'))
                                <span class="error-message">{{ clean($errors->first('instagram')) }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group {{ $errors->has('linkedin') ? 'has-error': '' }}">
                            <label for="">
                                {{ clean(trans('cynoebook::account.profile.linkedin')) }}
                            </label>

                            <input type="text" name="linkedin" id="linkedin" class="form-control" value="{{ old('linkedin', $my->linkedin) }}">

                            @if($errors->has('linkedin'))
                                <span class="error-message">{{ clean($errors->first('linkedin')) }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group {{ $errors->has('youtube') ? 'has-error': '' }}">
                            <label for="">
                                {{ clean(trans('cynoebook::account.profile.youtube')) }}
                            </label>

                            <input type="text" name="youtube" id="youtube" class="form-control" value="{{ old('youtube', $my->youtube) }}">

                            @if($errors->has('youtube'))
                                <span class="error-message">{{ clean($errors->first('youtube')) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="password">
                <h4>{{ clean(trans('cynoebook::account.profile.password')) }}</h4>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group {{ $errors->has('password') ? 'has-error': '' }}">
                            <label for="new-password">
                                {{ clean(trans('cynoebook::account.profile.new_password')) }}
                            </label>

                            <input type="password" name="password" id="new-password" class="form-control">

                            @if($errors->has('password'))
                                <span class="error-message">{{ clean($errors->first('password')) }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error': '' }}">
                            <label for="confirm-password">
                                {{ clean(trans('cynoebook::account.profile.confirm_password')) }}
                            </label>

                            <input type="password" name="password_confirmation" id="confirm-password" class="form-control">

                            @if($errors->has('password_confirmation'))
                                <span class="error-message">{{ clean($errors->first('password_confirmation')) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" data-loading>
            {{ clean(trans('cynoebook::account.profile.save_changes')) }}
        </button>
    </form>
@endsection
