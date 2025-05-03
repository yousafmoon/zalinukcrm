<?php
namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($role) {
            $role->guard_name = $role->guard_name ?? config('auth.defaults.guard');
        });
    }
}