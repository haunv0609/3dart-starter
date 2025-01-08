<?php

// Route::group([
//     'namespace' => '\Haunv\3dartStarter\Controllers',
//     'middleware' => config('starter.middleware'),
//     'name' => config('starter.name_route'),
//     'prefix' => config('starter.prefix_route'),
//     ], function() {
//     Route::resource('/roles', RoleController::class);
//     Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
//     Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
//     Route::resource('/permissions', PermissionController::class);
//     Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
//     Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
//     Route::get('/users', [UserController::class, 'index'])->name('users.index');
//     Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
//     Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
//     Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
//     Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
//     Route::post('register', [UserController::class, 'register'])->name('register-users');
//     Route::put('password-user/{user}', [UserController::class, 'changePassUser'])->name('resetPasswordUser');
// });
