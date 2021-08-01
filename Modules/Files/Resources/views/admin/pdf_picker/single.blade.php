<div class="form-group row ">
    <label for="about" class="col-md-4 text-left">
        <h4>{{ $title }}</h4>
    </label>
    <div class="single-image-wrapper col-md-8 p-0">
       
        <div class="single-image image-holder-wrapper pull-left">
            @if (! $file->exists)
                <div class="image-holder placeholder">
                    <i class="fas fa-file-upload"></i>
                </div>
            @else
                <div class="image-holder">
                    <i class="fas fa-file"></i>
                    <button type="button" class="btn remove-pdf" data-input-name="{{ $inputName }}"></button>
                    <input type="hidden" name="{{ $inputName }}" value="{{ $file->id }}">
                    <textarea class="form-control file-display-name" readonly="1">{{ $file->filename }}</textarea>
                </div>
            @endif
        </div>
        
        <button type="button" class="pdf-picker btn btn-default btn-border pull-left" data-input-name="{{ $inputName }}" data-filetype="{{ $fileType }}">
            <i class="fas fa-folder-open mr-2"></i> {{ clean(trans('files::files.browse')) }}
        </button>
        <div class="clearfix"></div>
        <div class="pdf-file-result">
            @if ($file->exists)
                {{ Form::text('ebook_file', '', $errors, '', ['labelCol' => 0, 'required' => true,' readonly'=>true,'style'=>'display:none;','value'=>$file->filename,'class'=>'pdf-file-name']) }}
            @else
                {{ Form::text('ebook_file', '', $errors, '', ['labelCol' => 0, 'required' => true,' readonly'=>true,'style'=>'display:none;','value'=>'','class'=>'pdf-file-name']) }}
            @endif
        </div>
    </div>
</div>
