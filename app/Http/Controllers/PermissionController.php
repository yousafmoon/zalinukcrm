<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Http\Resources\PermissionResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PermissionController extends Controller
{
    use AuthorizesRequests;
    public static function middleware(): array
    {
        $this->middleware('permission:view permissions')->only('index');
        $this->middleware('permission:create permissions')->only('create', 'store');
        $this->middleware('permission:edit permissions')->only('edit', 'update');
        $this->middleware('permission:delete permissions')->only('destroy');
    }
    
    public function index(Request $request)
    {
        $this->authorize('viewAny', Permission::class);
        $permissionsQuery = Permission::query()->orderBy('name', 'DESC');
        $this->applySearch($permissionsQuery, $request->search);

        $permissions = PermissionResource::collection($permissionsQuery->paginate(10));
        return inertia('Permissions/Index', [
            'permissions' => $permissions,
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
        $this->authorize('create', Permission::class);
        return inertia('Permissions/Create');
    }

    public function store(StorePermissionRequest $request)
    {
        $this->authorize('create', Permission::class);
        Permission::create($request->validated());
        
       if ($request->has('permissions')) {
        $role->syncPermissions($request->permissions);
       }
       
        return redirect()->route('permissions.index')->with('message', 'Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        $this->authorize('update', $permission); 
        return inertia('Permissions/Edit', [
            'permission' => new PermissionResource($permission),
        ]);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $this->authorize('update', $permission); 
        $permission->update($request->validated());
        return redirect()->route('permissions.index')->with('message', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        $this->authorize('delete', $permission); 
        $permission->delete();
        return redirect()->route('permissions.index')->with('message', 'Permission deleted successfully.');
    }
}