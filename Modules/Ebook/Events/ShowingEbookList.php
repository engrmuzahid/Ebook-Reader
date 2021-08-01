<?php

namespace Modules\Ebook\Events;

use Illuminate\Queue\SerializesModels;

class ShowingEbookList
{
    use SerializesModels;

    /**
     * Collection of ebook.
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    public $ebooks;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ebooks)
    {
        $this->ebooks = $ebooks;
    }
}
