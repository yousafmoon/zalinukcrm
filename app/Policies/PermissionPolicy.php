<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    private function hasAccess(User $user, string $permissionName): bool
    {
        $rolesWithAccess = ['admin']; 
        foreach ($rolesWithAccess as $role) {
            if ($user->hasRole($role)) {
                return true;
            }
        }

        return $user->hasPermissionTo($permissionName);
    }

    public function viewAny(User $user): bool
    {
        return $this->hasAccess($user, 'View permissions');
    }

    public function create(User $user): bool
    {
        return $this->hasAccess($user, 'Create Permissions');
    }

    public function update(User $user, Permission $permission): bool
    {
        return $this->hasAccess($user, 'Edit Permissions');
    }

    public function delete(User $user, Permission $permission): bool
    {
        return $this->hasAccess($user, 'Delete Permissions');
    }

    public function restore(User $user, Permission $permission): bool
    {
        return false; 
    }

    public function forceDelete(User $user, Permission $permission): bool
    {
        return false; 
    }
}
