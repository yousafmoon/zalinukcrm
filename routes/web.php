<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Student;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $user = Auth::user(); 
    $totalStudents = Student::count();
    $students = Student::all();

    return Inertia::render('Dashboard', [
        'students' => $students,
        'totalStudents' => $totalStudents,
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'roles' => $user->roles->pluck('name'),
            'permissions' => $user->getAllPermissions()->pluck('name')
        ]
    ]);
})->middleware(['auth'])->name('dashboard');


Route::get('/students', function () {
    return Inertia::render('Students');
})->middleware(['auth', 'verified'])->name('students');

Route::get('/permissions', function () {
    return Inertia::render('Permissions');
})->middleware(['auth', 'verified'])->name('permissions');

Route::get('/roles', function () {
    return Inertia::render('Roles');
})->middleware(['auth', 'verified'])->name('roles');

Route::get('/users', function () {
    return Inertia::render('Users');
})->middleware(['auth', 'verified'])->name('users');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/upload-image', [ProfileController::class, 'uploadProfileImage'])->name('profile.upload-image');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('students', StudentController::class)->middleware(['auth']);
    Route::resource('permissions', PermissionController::class)->middleware(['auth']);
    Route::resource('roles', RoleController::class)->middleware(['auth']);
    Route::resource('users', UserController::class)->middleware(['auth']);

});



require __DIR__.'/auth.php';
