<?php

namespace App\Listeners;

use App\Events\ModelRated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ModelRatedNotification;

class SendEmailModelRatedNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle(ModelRated $event)
    {
        $rateable = $event->getRateable();

        if ($reateable instanceof Product) {
            $notification = new ModelRatedNotification(
                $event->getQualifier()->name,
                $rateable->name,
                $event->getScore()
            );

            $rateable->createdBy()->notify($notification);
        }
    }
}
