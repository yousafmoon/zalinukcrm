<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;
    private function hasAccess(User $user, string $permission): bool
    {
        $rolesWithAccess = ['Admin', 'Editor', 'Staff']; 
        foreach ($rolesWithAccess as $role) {
            if ($user->hasRole($role)) {
                return true;
            }
        }
        return $user->hasPermissionTo($permission);
    }
    
    public function viewAny(User $user): bool
    {
        return $this->hasAccess($user, 'View Students');
    }

    public function create(User $user): bool
    {
        return $this->hasAccess($user, 'Create Students');
    }

    public function update(User $user, Student $student): bool
    {
        return $this->hasAccess($user, 'Edit Students');
    }

    public function delete(User $user, Student $student): bool
    {
        return $this->hasAccess($user, 'Delete Students');
    }

    public function restore(User $user, Student $student): bool
    {
        return false; 
    }

    public function forceDelete(User $user, Student $student): bool
    {
        return false; 
    }
}
