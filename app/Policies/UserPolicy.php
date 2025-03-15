<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    private function hasAccess(User $user, string $permission): bool
    {
        $rolesWithAccess = ['Admin'];
        foreach ($rolesWithAccess as $roleWithAccess) { 
            if ($user->hasRole($roleWithAccess)) {
                return true;
            }
        }
        return $user->hasPermissionTo($permission);  
    }
    
    public function viewAny(User $user): bool
    {
        return $this->hasAccess($user, 'view Users');
    }

    public function create(User $user): bool
    {
        return $this->hasAccess($user, 'Create Users');
    }

    public function update(User $user, User $model): bool
    {
        return $this->hasAccess($user, 'Edit Users');
    }

    public function delete(User $user, User $model): bool
    {
        return $this->hasAccess($user, 'Delete Users');
    }

    public function restore(User $user, User $model): bool
    {
        return false; 
    }

    public function forceDelete(User $user, User $model): bool
    {
        return false; 
    }
}
