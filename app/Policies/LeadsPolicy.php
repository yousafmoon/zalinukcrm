<?php

namespace App\Policies;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadPolicy
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
        return $this->hasAccess($user, 'View Leads');
    }

    public function create(User $user): bool
    {
        return $this->hasAccess($user, 'Create Leads');
    }

    public function update(User $user, Lead $lead): bool
    {
        return $this->hasAccess($user, 'Edit Leads');
    }

    public function delete(User $user, Lead $lead): bool
    {
        return $this->hasAccess($user, 'Delete Leads');
    }

    public function restore(User $user, Lead $lead): bool
    {
        return false; 
    }

    public function forceDelete(User $user, Lead $lead): bool
    {
        return false; 
    }
}
