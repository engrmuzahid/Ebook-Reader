<?php

namespace Modules\Ebook\Listeners;

use Modules\Ebook\Events\EbookViewed;

class IncrementEbookView
{
    /**
     * Handle the event.
     *
     * @param \Modules\ebook\Events\EbookViewed $event
     * @return void
     */
    public function handle(EbookViewed $event)
    {
        $event->ebook->increment('viewed');
    }
}
