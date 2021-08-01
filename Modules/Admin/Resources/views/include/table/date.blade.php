<span data-toggle="tooltip" title="{{ is_null($date) ? '' : $date->toFormattedDateString() }}">
    {{ is_null($date) ? '-' : $date->diffForHumans() }}
</span>
