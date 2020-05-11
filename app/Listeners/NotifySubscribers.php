<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifySubscribers
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $thread = $event->reply->thread;
        $thread->subscriptions
            ->where('user_id', '!=', $event->reply->user->id)
            ->each->notify($event->reply);
    }
}
