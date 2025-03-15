<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;
    private function hasAccess(User $user, string $permission): bool
    {
        $rolesWithAccess = ['Admin']; 
        foreach ($rolesWithAccess as $role) {
            if ($user->hasRole($role)) {
                return true;
            }
        }
        return $user->hasPermissionTo($permission);
    }
    public function viewAny(User $user): bool
    {
        return $this->hasAccess($user, 'view Roles');
    }
    public function create(User $user): bool
    {
        return $this->hasAccess($user, 'Create Roles');
    }

    public function update(User $user, Role $role): bool
    {
        return $this->hasAccess($user, 'Edit Roles');
    }

    public function delete(User $user, Role $role): bool
    {
        return $this->hasAccess($user, 'Delete Roles');
    }

    public function restore(User $user, Role $role): bool
    {
        return false; 
    }

    public function forceDelete(User $user, Role $role): bool
    {
        return false; 
    }
}
