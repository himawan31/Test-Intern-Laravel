<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/auth/login');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/projects/{id}/show', [ProjectController::class, 'show'])->name('projects.show');
    Route::put('/tasks/{id}/progress', [TaskController::class, 'updateProgress'])->name('tasks.updateProgress');

    // Routes khusus untuk Admin
    Route::middleware('admin')->group(function () {

        // Project routes
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

        // Manage project members
        Route::post('/projects/{project}/members/{user}', [ProjectController::class, 'addMember'])->name('projects.members.add');
        Route::get('/projects/{id}/members', [ProjectController::class, 'manageMembers'])->name('projects.members.manage');
        Route::put('/projects/{id}/members', [ProjectController::class, 'updateMembers'])->name('projects.members.update');
        Route::delete('/projects/{project}/members/{user}', [ProjectController::class, 'removeMember'])->name('projects.members.destroy');

        // Task routes
        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('/projects/{projectId}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/projects/{projectId}/tasks', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
        Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

        // User routes
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Profile routes (untuk semua user)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
