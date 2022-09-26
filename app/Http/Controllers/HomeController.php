<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\User;
use App\Notifications\UserTestNotification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function notify()
    {
        $user = User::where([
            'name' => 'name1',
            'email' => 'name@name.com',
        ])->first();

        $user2 = User::where([
            'name' => 'name2',
            'email' => 'name2@name.com',
        ])->first();

        $user2->notify(new UserTestNotification($user));
        event(new MyEvent('is this shit working?'));
    }
}
