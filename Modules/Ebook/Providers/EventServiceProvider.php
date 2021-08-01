<?php

namespace Modules\Ebook\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Modules\Ebook\Events\EbookViewed::class => [
            \Modules\Ebook\Listeners\IncrementEbookView::class,
            
        ],
    ];
}
