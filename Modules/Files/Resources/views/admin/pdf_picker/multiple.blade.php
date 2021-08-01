<div class="form-group row ">
    <label for="about" class="col-md-4 text-left">
        <h4>{{ $title }}</h4>
    </label>
    <div class="multiple-images-wrapper col-md-8 p-0">
        <button type="button" class="pdf-picker btn btn-default btn-border  clearfix" data-input-name="{{ $inputName }}" data-multiple data-filetype="{{ $fileType }}">
            <i class="fas fa-folder-open mr-2"></i> {{ clean(trans('files::files.browse')) }}
        </button>
        <div class="multiple-images" data-input-validation="{{ $inputValidation }}">
            <div class="image-list image-holder-wrapper notRequired clearfix">
                @if ( $files->isEmpty())
                    <div class="image-holder placeholder cursor-auto">
                        <i class="fas fa-file-upload"></i>
                    </div>
                @else
                    @foreach ($files as $file)
                        <div class="image-holder">
                            <i class="fas fa-file"></i>
                            <button type="button" class="btn remove-pdf"data-input-name="{{ $inputName }}" data-input-validation="{{ $inputValidation }}" ></button>
                            <input type="hidden" name="{{ $inputName }}" value="{{ $file->id }}">
                            <textarea class="form-control file-display-name" readonly="1">{{ $file->filename }}</textarea>
                        </div>
                    @endforeach
                @endif
            </div>
                
        </div>
        
        

        
    </div>
</div>
