<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');

    Route::get('/admin/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
    Route::get('/admin/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
    Route::post('/admin/posts', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
    Route::delete('/admin/posts/{post}/destroy', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
    Route::patch('/admin/posts/{post}/update', [App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
   
    Route::get('/admin/users/{user}/profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
    Route::put('/admin/users/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
    Route::delete('/admin/users/{user}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::delete('/roles/{role}/destroy', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}/update', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');


    Route::get('/permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissions/create', [App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
    Route::delete('/permissions/{permission}/destroy', [App\Http\Controllers\PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::get('/permissions/{permission}/edit', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/{permission}/update', [App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update');





    
});

Route::middleware(['role:admin','auth'])->group(function () { 
    Route::get('admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::put('users/{user}/attach', [App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');
    Route::put('users/{user}/detach', [App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');
    
    Route::put('roles/{role}/attach', [App\Http\Controllers\RoleController::class, 'attach'])->name('role.permission.attach');
    Route::put('roles/{role}/detach', [App\Http\Controllers\RoleController::class, 'detach'])->name('role.permission.detach');

});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
