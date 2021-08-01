@extends('installer.layout')

@section('content')
<div class="tab-content">
    <div class="tab-pane active" id="details">
        <div class="row">
            @if (session()->has('error'))
                <div class="alert alert-danger fade in alert-dismissable">
                    {{ clean(session('error')) }}
                </div>
            @endif
            
            <div class="col-sm-12">
                <h4 class="info-text">Please enter your database connection details.</h4>
            </div>

            <div class="col-sm-12">
                <div class="col-sm-6">
                    <div class="form-group required label-floating  {{ $errors->has('db.host') ? 'has-error': '' }}" >
                        <label class="control-label" for="host">Database Host <span>*</span></label>
                        <input type="text" name="db[host]" value="{{ old('db.host', '127.0.0.1') }}" id="host" class="form-control" autofocus>
                        @if($errors->has('db.host'))
                            <span class="help-block error">{{ clean($errors->first('db.host')) }}</span>
                        @endif
                    </div>
                    
                    <div class="form-group required label-floating {{ $errors->has('db.username') ? 'has-error': '' }}">
                        <label class="control-label" for="db-username">Database Username <span>*</span></label>
                        <input type="text" name="db[username]" value="{{ old('db.username') }}" id="db-username" class="form-control">
                        @if($errors->has('db.username'))
                            <span class="help-block error">{{ clean($errors->first('db.username')) }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group required label-floating  {{ $errors->has('db.port') ? 'has-error': '' }}" >
                        <label class="control-label" for="port">Database Port <span>*</span></label>
                        <input type="text" name="db[port]" value="{{ old('db.port', '3306') }}" id="port" class="form-control">
                        @if($errors->has('db.port'))
                            <span class="help-block error">{{ clean($errors->first('db.port')) }}</span>
                        @endif
                    </div>
                    <div class="form-group required label-floating">
                        <label class="control-label" for="db-password">Database Password</label>

                        <input type="password" name="db[password]" value="{{ old('db.password') }}" id="db-password" class="form-control">
                        
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group required label-floating {{ $errors->has('db.database') ? 'has-error': '' }}">
                        <label class="control-label" for="database">Database Name <span>*</span></label>
                        <input type="text" name="db[database]" value="{{ old('db.database') }}" id="database" class="form-control">
                        @if($errors->has('db.database'))
                            <span class="help-block error">{{ clean($errors->first('db.database')) }}</span>
                        @endif
                    </div>
                </div>    

            </div>
                
            <div class="col-sm-12">
                <h4 class="info-text">Please enter a username and password for the administration.</h4>
            </div>    
            
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <div class="form-group required label-floating {{ $errors->has('admin.first_name') ? 'has-error': '' }}">
                        <label class="control-label" for="admin-first-name">First Name <span>*</span></label>
                        <input type="text" name="admin[first_name]" value="{{ old('admin.first_name') }}" id="admin-first-name" class="form-control">
                        @if($errors->has('admin.first_name'))
                            <span class="help-block error">{{ clean($errors->first('admin.first_name')) }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group required label-floating {{ $errors->has('admin.last_name') ? 'has-error': '' }}">
                        <label class="control-label" for="admin-last-name">Last Name <span>*</span></label>
                        <input type="text" name="admin[last_name]" value="{{ old('admin.last_name') }}" id="admin-last-name" class="form-control">
                        @if($errors->has('admin.last_name'))
                            <span class="help-block error">{{ clean($errors->first('admin.last_name')) }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group required label-floating {{ $errors->has('admin.username') ? 'has-error': '' }}">
                        <label class="control-label" for="admin-email">UserName <span>*</span></label>
                        <input type="text" name="admin[username]" value="{{ old('admin.username') }}" id="admin-username" class="form-control">
                        @if($errors->has('admin.username'))
                            <span class="help-block error">{{ clean($errors->first('admin.username')) }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group required label-floating {{ $errors->has('admin.email') ? 'has-error': '' }}">
                        <label class="control-label" for="admin-email">Email <span>*</span></label>
                        <input type="text" name="admin[email]" value="{{ old('admin.email') }}" id="admin-email" class="form-control">
                        @if($errors->has('admin.email'))
                            <span class="help-block error">{{ clean($errors->first('admin.email')) }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group required label-floating {{ $errors->has('admin.password') ? 'has-error': '' }}">
                        <label class="control-label" for="admin-password">Password <span>*</span></label>
                        <input type="password" name="admin[password]" value="{{ old('admin.password') }}" id="admin-password" class="form-control">
                        @if($errors->has('admin.password'))
                            <span class="help-block error">{{ clean($errors->first('admin.password')) }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group required label-floating">
                        <label class="control-label" for="admin-confirm-password">Confirm Password <span>*</span></label>
                        <input type="password" name="admin[password_confirmation]" id="admin-confirm-password" class="form-control">
                    </div>
                </div>
                
            </div>
            
            <div class="col-sm-12">
            
                <h4 class="info-text">Please enter your site details.</h4>
            </div>
            
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <div class="form-group required label-floating {{ $errors->has('site.site_name') ? 'has-error': '' }}">
                        <label class="control-label" for="site-name">Site Name <span>*</span></label>
                        <input type="text" name="site[site_name]" value="{{ old('site.site_name') }}" id="site-name" class="form-control">
                        @if($errors->has('site.site_name'))
                            <span class="help-block error">{{ clean($errors->first('site.site_name')) }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group required label-floating {{ $errors->has('site.site_email') ? 'has-error': '' }}">
                        <label class="control-label" for="site-email">Site Email <span>*</span></label>
                        <input type="text" name="site[site_email]" value="{{ old('site.site_email') }}" id="site-email" class="form-control">
                        @if($errors->has('site.site_email'))
                            <span class="help-block error">{{ clean($errors->first('site.site_email')) }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <div class="wizard-footer">
    <div class="pull-right">
        <button type="submit" name='next' class="btn btn-next btn-fill btn-danger btn-wd install-button"><i class="fa fa-refresh fa-spin"></i> Save & Install</button>
        
    </div>
    <div class="clearfix"></div>
</div>   
@endsection

@push('scripts')
    <script>
    (function () {
        "use strict";
        $('.install-button').on('click', function (e) {
            
            var button = $(e.currentTarget);

            button.data('loading-text', button.html())
                .addClass('btn-loading')
                .button('loading');
                
            
        });
    })();
    </script>
@endpush
