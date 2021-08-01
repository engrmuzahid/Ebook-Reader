<div class="row permission-row">
    <div class="col-md-12">
        <div class="btn-group permission-all pull-right">
            <button type="button" class="btn btn-default btn-sm btn-action-all" data-action="allow">{{ clean(trans('user::roles.permissions.allow_all'))}}</button>
            <button type="button" class="btn btn-default btn-sm btn-action-all" data-action="deny">{{ clean(trans('user::roles.permissions.deny_all'))}}</button>
            <button type="button" class="btn btn-default btn-sm btn-action-all" data-action="inherit">{{ clean(trans('user::roles.permissions.inherit_all'))}}</button>
        </div>
    </div>
</div>

@foreach ($permissions as $module => $modulePermissions)
    <div class="row permission-row">
        <div class="col-md-12">
            <h2 class="border-bottom">{{ clean($module) }}</h2>
        </div>
    </div>
    
    @foreach ($modulePermissions as $group => $groupPermissions)
    <div class="permission-group">
        <div class="row permission-row">
            <div class="col-md-6 col-4 pl-4">
                <h3>{{ clean($group) }}</h3>
            </div>
            <div class="col-md-6 col-8">
                <div class="btn-group permission-group-all pull-right">
                    <button type="button" class="btn btn-default btn-sm btn-action-all" data-action="allow">{{ clean(trans('user::roles.permissions.allow_all'))}}</button>
                    <button type="button" class="btn btn-default btn-sm btn-action-all" data-action="deny">{{ clean(trans('user::roles.permissions.deny_all'))}}</button>
                    <button type="button" class="btn btn-default btn-sm btn-action-all" data-action="inherit">{{ clean(trans('user::roles.permissions.inherit_all'))}}</button>
                </div>
            </div>
        </div>
        
        @foreach ($groupPermissions as $permissionAction => $permissionLabel)
            
                <div class="row permission-row">
                    <div class="col-md-6 col-4 pl-5">
                        <p>{{ clean(trans($permissionLabel)) }}</p>
                    </div>
                    <div class="col-md-6 col-8 text-right">
                        @if (! is_null($entity))
                            @php
                                $permissionValue = old('permissions')["{$group}.{$permissionAction}"] ?? permission_value($entity->permissions ?: [], "{$group}.{$permissionAction}")
                            @endphp
                        @endif
                        <div class="form-check form-check-inline p-0 m-0">
                            
                            <div class="custom-control custom-radio">
                                <input type="radio" value="1" id="{{ "{$group}-{$permissionAction}" }}-allow" name="permissions[{{ "{$group}.{$permissionAction}" }}]" class="custom-control-input permission-allow" {{ isset($permissionValue) && $permissionValue == 1 ? 'checked' : '' }}>

                                <label class="custom-control-label" for="{{ "{$group}-{$permissionAction}" }}-allow">{{ trans('user::roles.permissions.allow') }}</label>
                            </div>
                            
                            <div class="custom-control custom-radio">
                                <input type="radio" value="-1" id="{{ "{$group}-{$permissionAction}" }}-deny" name="permissions[{{ "{$group}.{$permissionAction}" }}]" class="custom-control-input permission-deny" {{ isset($permissionValue) && $permissionValue == -1 ? 'checked' : '' }}>

                                <label class="custom-control-label" for="{{ "{$group}-{$permissionAction}" }}-deny">{{ trans('user::roles.permissions.deny') }}</label>
                            </div>
                            
                            <div class="custom-control custom-radio">
                                <input type="radio" value="0" id="{{ "{$group}-{$permissionAction}" }}-inherit" name="permissions[{{ "{$group}.{$permissionAction}" }}]" class="custom-control-input permission-inherit" {{ isset($permissionValue) && $permissionValue == 0 ? 'checked' : '' }}>

                                <label class="custom-control-label" for="{{ "{$group}-{$permissionAction}" }}-inherit">{{ trans('user::roles.permissions.inherit') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            
        @endforeach
    </div>
    @endforeach
        
@endforeach
