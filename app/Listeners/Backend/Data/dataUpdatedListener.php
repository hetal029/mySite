<?php

namespace App\Listeners\Backend\Data;

use App\Events\Backend\Data\dataUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class dataUpdatedListener
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
     * @param  dataUpdated  $event
     * @return void
     */
    public function handle(dataUpdated $event)
    {
        //
    }
}
