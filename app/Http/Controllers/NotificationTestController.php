<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NotificationTest;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class NotificationTestController extends Controller
{
    use Notifiable;

    public function sendNotification() {
        $user = User::first();

        $data = [
            'body' => 'The introduction to the test notification.',
            'action' => 'yet to implement',
            'url' => url('/')
        ];

        $user->notify(new NotificationTest($data));
    }
}
