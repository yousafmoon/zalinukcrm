<?php

namespace App\Policies;

use App\Models\Documents;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentsPolicy
{
    use HandlesAuthorization;
    private function hasAccess(User $user, string $permission): bool
    {
        $rolesWithAccess = ['admin']; 
        foreach ($rolesWithAccess as $role) {
            if ($user->hasRole($role)) {
                return true;
            }
        }
        return $user->hasPermissionTo($permission);
    }
    
    public function viewAny(User $user): bool
    {
        return $this->hasAccess($user, 'View Documents');
    }

    public function create(User $user): bool
    {
        return $this->hasAccess($user, 'Create Documents');
    }

    public function update(User $user, Documents $documents): bool
    {
        return $this->hasAccess($user, 'Edit Documents');
    }

    public function delete(User $user, Documents $documents): bool
    {
        return $this->hasAccess($user, 'Delete Documents');
    }

    public function restore(User $user, Documents $documents): bool
    {
        return false; 
    }

    public function forceDelete(User $user, Documents $documents): bool
    {
        return false; 
    }
}
