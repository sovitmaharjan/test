<?php

namespace App\Traits;

use App\Models\Role;

trait HasPermissionTrait
{
    public function role()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }
}
