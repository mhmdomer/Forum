<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show(User $user) {
        $activities = Activity::feed($user);
        return view('profiles.show')->with([
            'userProfile' => $user,
            'activities' => $activities
        ]);
    }
}
