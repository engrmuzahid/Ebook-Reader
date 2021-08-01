<div class="row">
    <div class="col-md-12">
        <div class="accordion accordion-secondary ci-accordion" id="{{ $name }}">
            <div class="row">  
                <div class="col-lg-3 col-md-4">
                
                    @foreach ($groups as $group => $options)
                    <div class="card ci-nav-tabs">
                        <div class="card-header {{ ($options['active'] ?? false) ? '' : 'collapsed' }} {{ $tabs->group($group)->hasError() ? 'has-error' : '' }}" 
                            @if (count($groups) > 1)
                                data-toggle="collapse" data-target="#{{ $group }}"
                            @endif
                            {{ ($options['active'] ?? false) ? 'aria-expanded="true"' : '' }}
                        >
                            <div class="span-title">
                               {{ clean($options['title']) }}
                            </div>
                            <div class="span-mode"></div>
                        </div>

                        <div id="{{ $group }}" class="collapse {{ ($options['active'] ?? false) ? 'show' : '' }}" data-parent="#{{ $name }}">
                            <div class="card-body">
                                <div class="nav flex-column nav-pills nav-secondary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    {{ $tabs->group($group)->navs() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        {{ $contents }}
                        
                    </div>
                </div>
            
            </div>
        </div>
            
    </div>
</div>