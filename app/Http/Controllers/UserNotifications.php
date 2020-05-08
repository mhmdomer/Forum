<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserNotifications extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return auth()->user()->unreadNotifications;
    }

    public function destroy(User $user, $notificationId) {
        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
    }
}
