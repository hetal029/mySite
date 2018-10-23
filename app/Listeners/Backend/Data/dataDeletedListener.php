<?php

namespace App\Listeners\Backend\Data;

use App\Events\Backend\Data\dataDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class dataDeletedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  dataDeleted  $event
     * @return void
     */
    public function handle(dataDeleted $event)
    {
        //
    }
}
