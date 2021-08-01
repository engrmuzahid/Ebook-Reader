<div class="file-action">

@if(request()->type || request()->extension)
    <button type="button" class="btn btn-icon btn-default btn-border btn-xs select-media "
        data-id="{{ $file->id }}"
        data-path="{{ $file->path }}"
        data-filename="{{ $file->filename }}"
        data-type="{{ strtok($file->mime, '/') }}"
        data-icon="{{ $file->icon() }}"
        data-toggle="tooltip"
        data-placement="bottom"
        title="{{ clean(trans('files::files.select_this_file')) }}"
    >
       <i class="fas fa-file-medical"></i>
    </button>
@else
    <a class="btn btn-icon btn-default btn-border btn-xs" href="{{ route('admin.files.download',$download_key) }}"><i class="fas fa-download"></i></a>
    @if($file->extension=='pdf') 
        <a class="btn btn-icon btn-default btn-border btn-xs" href="{{ $file->path }}" data-fancybox="gallery" data-caption="{{ $file->filename }}" data-type="iframe"  ><i class="fas fa-eye"></i></a>
    @elseif($file->isImage()) 
        <a class="btn btn-icon btn-default btn-border btn-xs" href="{{ $file->path }}" class="fancybox" data-fancybox="gallery" data-caption="{{ $file->xs }}" ><i class="fas fa-eye"></i></a>
    @elseif($file->isVideo()) 
        <a class="btn btn-icon btn-default btn-border btn-xs" data-fancybox="gallery" href="{{ $file->path }}" data-caption="{{ $file->filename }}"   data-width="640" data-height="360" ><i class="fas fa-eye"></i></a>
    @else
        <a class="btn btn-icon btn-default btn-border btn-xs" href="{{ route('admin.files.download',$download_key) }}"><i class="fas fa-eye"></i></a>
    @endif
@endif
</div>