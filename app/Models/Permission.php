<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $fillable = ['name', 'guard_name']; 

    public static function boot()
    {
        parent::boot();

        static::creating(function ($permission) {
            if (empty($permission->guard_name)) {
                $permission->guard_name = config('auth.defaults.guard', 'web');
            }
        });
    }
}
