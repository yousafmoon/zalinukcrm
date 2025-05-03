<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function index (Request $request) {
        return $request->user()->only(['name', 'email', 'image']);
    }
    public function edit(Request $request): Response
    {
        $user = $request->user();
        $defaultImage = asset('/images/profile-pic.jpg'); 
        $imageUrl = $user->image && Storage::disk('public')->exists('profile_images/' . $user->image)
        ? asset('storage/profile_images/' . $user->image)
        : $defaultImage;
    
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'image_url' => $imageUrl,
                'roles' => $user->roles->pluck('name'),
            'permissions' => $user->getAllPermissions()->pluck('name')
            ],
            'defaultImage' => $defaultImage,
        ]);
    }
    

    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $user->fill($request->only(['name', 'email']));
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        $user->save();
        return redirect()->route('profile.update')
            ->with('message', 'Profile updated successfully.');
    }

    public function uploadProfileImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $user = $request->user();
        $defaultImage = Storage::url('images/profile-pic.jpg'); 
    
        if ($request->hasFile('image')) {
            $previousPath = $user->getRawOriginal('image');
            if ($previousPath && Storage::disk('public')->exists($previousPath)) {
                Storage::disk('public')->delete($previousPath);
            }
            $path = $request->file('image')->store('profile_images', 'public');
            $user->update(['image' => $path]);
        }
        $imageUrl = $user->image ? Storage::url($user->image) : $defaultImage;
    
        return response()->json([
            'image_url' => $imageUrl,  
            'message' => 'Profile image uploaded successfully.',
        ]);
    }
    
    
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}