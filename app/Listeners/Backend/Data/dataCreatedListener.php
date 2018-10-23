<?php

namespace App\Listeners\Backend\Data;

use App\Events\Backend\Data\dataCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class dataCreatedListener
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
     * @param  dataCreated  $event
     * @return void
     */
    public function handle(dataCreated $event)
    {
        //
    }
}
