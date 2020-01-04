<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show(User $user) {
        // return $user;
        return view('profiles.show')->with(['userProfile' => $user]);
    }
}
