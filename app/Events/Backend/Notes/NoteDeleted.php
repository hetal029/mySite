<?php

namespace App\Events\Backend\Notes;

use Illuminate\Queue\SerializesModels;

/**
 * Class BlogCreated.
 */
class NoteDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $notes;

    /**
     * @param $blogs
     */
    public function __construct($notes)
    {
        $this->notes = $notes;
    }
}
