<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

use Spatie\Permission\Models\Permission;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Resources\RoleResource;
use App\Http\Resources\PermissionResource;

class RoleController extends Controller
{
    use AuthorizesRequests;

    public static function middleware(): array
    {
        $this->middleware('permission:view roles')->only('index');
        $this->middleware('permission:create roles')->only('create', 'store');
        $this->middleware('permission:edit roles')->only('edit', 'update');
        $this->middleware('permission:delete roles')->only('destroy');
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Role::class);
        $rolesQuery = Role::with('permissions')->orderBy('name', 'ASC');
        $this->applySearch($rolesQuery, $request->search);

        $roles = RoleResource::collection($rolesQuery->paginate(10));
        return inertia('Roles/Index', [
            'roles' => $roles,
            'search' => $request->search ?? '',
        ]);
    }

    protected function applySearch($query, $search)
    {
       return $query->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }
    

    public function create()
    {
        $this->authorize('create', Role::class); 
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return inertia('Roles/Create', [
            'permissions'=> $permissions,
        ]);
    }

    public function store(StoreRoleRequest $request)
    {
        $this->authorize('create', Role::class); 
        $role = Role::create($request->validated());
        $role->syncPermissions($request->permissions);
       
        return redirect()->route('roles.index')->with('message', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $this->authorize('update', $role); 
        $role->load('permissions');
        $permissions = Permission::all()->map(function ($permission) use ($role) {
            return [
                'id' => $permission->id,
                'name' => $permission->name,
                'checked' => $role->permissions->contains($permission->id),
            ];
        });
    
        return inertia('Roles/Edit', [
            'role' => new RoleResource($role),
            'permissions' => $permissions, 
        ]);
    }
    
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->authorize('update', $role); 

        $role->update($request->validated());
        
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('message', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $role); 
        $role->delete();
        return redirect()->route('roles.index')->with('message', 'Role deleted successfully.');
    }
}