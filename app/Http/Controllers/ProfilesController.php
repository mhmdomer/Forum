<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }


    public function show(User $user) {
        $activities = Activity::feed($user);
        return view('profiles.show')->with([
            'userProfile' => $user,
            'activities' => $activities
        ]);
    }

    public function query($query) {
        return User::where('name', 'like', $query . '%')->select('name')->take(5)->pluck('name');
    }

    public function storeAvatar() {
        request()->validate([
            'avatar' => 'image'
        ]);
        auth()->user()->update([
            'avatar' => request()->file('avatar')->store('avatars', 'public')
        ]);
    }
}
