<div class="row">
    <div class="col-md-12">
         <div class="card">
            <div class="card-body">    
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" class="dropzone dz-clickable">
                            {{ csrf_field() }}
                            <input type="hidden" id="ufto" name="ufto" value="0" >
                            <div class="dz-message" data-dz-message>
                                <div class="icon">
                                    <i class="flaticon-file"></i>
                                </div>
                                <h4 class="message">{{ clean(trans('files::files.drop_drop_here')) }}</h4>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('general')
    <script>
    (function () {
        "use strict";
        CI.maxFileSize = "{{ (int) ini_get('upload_max_filesize') }}"
        CI.langs['files::files.success_message'] = '{{ clean(trans('files::files.success_message')) }}';
    })();  
    </script>
@endpush