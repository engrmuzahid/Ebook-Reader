<?php

namespace Modules\Ebook\Events;

use Illuminate\Queue\SerializesModels;

class EbookViewed
{
    use SerializesModels;

    /**
     * The ebook entity.
     *
     * @var \Modules\Ebook\Entities\Ebook
     */
    public $ebook;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ebook)
    {
        $this->ebook = $ebook;
    }
}
