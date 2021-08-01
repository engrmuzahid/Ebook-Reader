<div class="avatar-holder">
    @if (!is_null($path))
        <img src="{{ $path }}">
    @else
        <i class="fas fa-user"></i>
    @endif
</div>