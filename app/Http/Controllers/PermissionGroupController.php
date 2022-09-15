<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use Illuminate\Http\Request;

class PermissionGroupController extends Controller
{
    public function index(Request $request)
    {
        return PermissionGroup::with('permission')->get();
        $a = PermissionGroup::create([
            'name' => $request->name
        ]);
        return $a;
    }
}
