<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use Illuminate\Support\Facades\Storage;

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
<<<<<<< HEAD

    public function query($query) {
        return User::where('name', 'like', $query . '%')->select('name')->take(5)->pluck('name');
    }

    public function storeAvatar() {
        request()->validate([
            'avatar' => 'image'
        ]);
        $user = auth()->user();
        $oldName = $user->avatar;
        auth()->user()->update([
            'avatar' => request()->file('avatar')->store('avatars', 'public')
        ]);
        Storage::delete(str_replace('storage', 'public', $oldName));
        return response([], 204);
    }
||||||| merged common ancestors
=======

    public function query($query) {
        return User::where('name', 'like', $query . '%')->select('name')->take(5)->pluck('name');
    }
>>>>>>> 7b7bd647d658de230026b4730ef0cf595a7f769b
}
