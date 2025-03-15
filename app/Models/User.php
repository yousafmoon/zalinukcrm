<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Admin Permission Bypass
    public function hasPermissionTo($permission, $guardName = null): bool
    {
        if ($this->hasRole('admin')) {
            return true;
        }
        return parent::hasPermissionTo($permission, $guardName);
    }

    // Get role names, return "Guest" if no role exists
    public function getRoleNamesAttribute()
    {
        return $this->getRoleNames()->isEmpty() ? ['Guest'] : $this->getRoleNames();
    }

    // Handle profile image fallback
    public function getImageAttribute($value)
    {
        return $value
            ? asset('storage/' . $value)  
            : asset('images/profile-pic.jpg');  
    }
}