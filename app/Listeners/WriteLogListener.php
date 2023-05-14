<?php

namespace App\Listeners;

use App\Events\WriteLogEvent;
use App\Jobs\WriteLogSystemJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WriteLogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //TODO
    }

    /**
     * @param WriteLogEvent $event
     */

    public function handle(WriteLogEvent $event)
    {
//        Call Job Write Log
        WriteLogSystemJob::dispatch($event->getData());
    }
}
