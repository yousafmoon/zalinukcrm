<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;
    public static function middleware(): array
    {
        $this->middleware('permission:view users')->only('index');
        $this->middleware('permission:create users')->only('create', 'store');
        $this->middleware('permission:edit users')->only('edit', 'update');
        $this->middleware('permission:delete users')->only('destroy');
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        $usersQuery = User::with('roles')->orderBy('name', 'ASC'); 
        $this->applySearch($usersQuery, $request->search);
    
        $users = $usersQuery->paginate(10); 
        return inertia('Users/Index', [
            'users' => UserResource::collection($users), 
            'search' => $request->search ?? '',
        ]);
    }
    
    protected function applySearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        });
    }

    public function create()
    {
        $this->authorize('create', User::class); 
        $roles = Role::orderBy('name', 'ASC')->get();
        return inertia('Users/Create', [
            'roles'=> $roles,
        ]);
    }
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class); 
        $user = User::create($request->validated());
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('profile_images', 'public');
        }
        $roles = Role::all()->map(function ($role) use ($user) {
            return [
                'id' => $role->id,
                'name' => $role->name,
                'role_id'=>$role->id,
            ];
        });
        
        $user->syncRoles($request->roles);
       
        return redirect()->route('users.index')->with('message', 'User created successfully.');
    }
    
    
    public function edit(User $user)
    {
        $this->authorize('update', $user); 
        $user->load('roles'); 
        $roles = Role::all()->map(function ($role) use ($user) {
            return [
                'id' => $role->id,
                'name' => $role->name,
                'checked' => $user->roles->contains($role->id),
            ];
        });

        return inertia('Users/Edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->only(['name', 'email']);
   
        $user->update($data);
    
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }
    
        $user->roles()->sync($request->input('roles', []));
        return redirect()->route('users.index')->with('message', 'User updated successfully.');
    }
    

    public function destroy(User $user)
    {
        $this->authorize('delete', $user); 
        $user->delete();
        return redirect()->route('users.index')->with('message', 'User deleted successfully.');
    }
}