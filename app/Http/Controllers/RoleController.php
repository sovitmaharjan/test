<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        return Role::all();
        $a = Role::create([
            'name' => $request->name,
            'permission_group_id' => 1
        ]);
        return $a;
    }
}
