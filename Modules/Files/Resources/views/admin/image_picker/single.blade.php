<div class="form-group row ">
    <label for="about" class="col-md-4 text-left">
        <h4>{{ $title }}</h4>
        
    </label>
    <div class="single-image-wrapper col-md-8 p-0">
        
        
        <div class="single-image image-holder-wrapper  pull-left  ">
            @if (! $file->exists)
                <div class="image-holder placeholder">
                    <i class="fas fa-camera-retro"></i>
                </div>
            @else
                <div class="image-holder">
                    <img src="{{ $file->path }}">
                    <button type="button" class="btn remove-image" data-input-name="{{ $inputName }}"></button>
                    <input type="hidden" name="{{ $inputName }}" value="{{ $file->id }}">
                </div>
            @endif
        </div>
        <button type="button" class="image-picker btn btn-default btn-border pull-left clearfix" data-input-name="{{ $inputName }}">
            <i class="fas fa-folder-open mr-2"></i> {{ clean(trans('files::files.browse')) }}
        </button>
    </div>
</div>