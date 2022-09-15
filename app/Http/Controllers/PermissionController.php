<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        return Permission::all();
        $a = Permission::create([
            'name' => $request->name,
            'permission_group_id' => 1
        ]);
        return $a;
    }
}
