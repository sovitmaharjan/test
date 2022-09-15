<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        $role = Role::find(1);
        $user->role()->sync($role);
        return User::with('role')->get();
        $a = User::create([
            'name' => 'user2',
            'email' => 'user2@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return $a;
    }
}
