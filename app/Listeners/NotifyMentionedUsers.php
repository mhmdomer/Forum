<?php

namespace App\Listeners;

use App\Notifications\YouWhereMentioned;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyMentionedUsers
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        preg_match_all('/@([^\s\.]+)/', $event->reply->body, $matches);
        $names = $matches[1];
        foreach ($names as $name) {
            $user = User::whereName($name)->first();
            if($user) {
                $user->notify(new YouWhereMentioned($event->reply));
            }
        }
    }
}
