<?php

namespace App\Policies;

use App\Reply;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RepliesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any replies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Reply  $reply
     * @return mixed
     */
    public function view(User $user, Reply $reply)
    {
        //
    }

    /**
     * Determine whether the user can create replies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $recentReply = $user->fresh()->latestReply();
        if (!$recentReply) return true;
        return !$recentReply->wasJustPublished();
    }

    /**
     * Determine whether the user can update the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Reply  $reply
     * @return mixed
     */
    public function update(User $user, Reply $reply)
    {
        if($user->id != $reply->user->id) return false;
        return !$reply->wasJustUpdated();
    }

    /**
     * Determine whether the user can delete the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Reply  $reply
     * @return mixed
     */
    public function delete(User $user, Reply $reply)
    {
        return $user->id == $reply->user->id;
    }

    /**
     * Determine whether the user can restore the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Reply  $reply
     * @return mixed
     */
    public function restore(User $user, Reply $reply)
    {
        return $user->id == $reply->user->id;
    }

    /**
     * Determine whether the user can permanently delete the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Reply  $reply
     * @return mixed
     */
    public function forceDelete(User $user, Reply $reply)
    {
        return $user->id == $reply->user->id;
    }
}
