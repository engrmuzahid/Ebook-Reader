<div class="avatar-holder">
    @if (is_null($path))
        <i class="fas fa-image"></i>
    @else
        <img src="{{ $path }}">
    @endif
</div>
