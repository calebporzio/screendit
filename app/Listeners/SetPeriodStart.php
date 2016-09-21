<?php

namespace App\Listeners;

use App\Events\Laravel\Spark\Events\Subscription\UserSubscribed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetPeriodStart
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
     * @param  UserSubscribed  $event
     * @return void
     */
    public function handle(UserSubscribed $event)
    {
        if ($event->fromRegistration) {
            $event->user->setPeriodStart();
        }
    }
}
