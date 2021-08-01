<div class="avatar-holder">
    @if ($file->isImage())
        <img src="{{ $file->path }}">
    @else
        <i class="file-icon fa {{ $file->icon() }}"></i>
    @endif
</div>