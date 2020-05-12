<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersPolicy
{
    use HandlesAuthorization;

    public function create(User $user, User $signedInUser) {
        return $user->id === $signedInUser->id;
    }
}
