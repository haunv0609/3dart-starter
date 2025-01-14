<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// // Trang chủ
// Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
//     $trail->push('Trang chủ', route('home'));
// });

// Quản lý vai trò
Breadcrumbs::for('admin.roles.index', function (BreadcrumbTrail $trail) {
    $trail->push('Danh sách vai trò', route('admin.roles.index'));
});

// Quản lý vai trò > Thông tin vai trò
Breadcrumbs::for('admin.roles.show', function (BreadcrumbTrail $trail, $roles) {
    $trail->parent('admin.roles.index');
    $trail->push($roles->name ? $roles->name : '', route('admin.roles.show', $roles));
});

// Quản lý phân quyền
Breadcrumbs::for('admin.permissions.index', function (BreadcrumbTrail $trail) {
    $trail->push('Danh sách phân quyền', route('admin.permissions.index'));
});

// Quản lý phân quyền > Thông tin phân quyền
Breadcrumbs::for('admin.permissions.show', function (BreadcrumbTrail $trail, $permissions) {
    $trail->parent('admin.permissions.index');
    $trail->push($permissions->description ? $permissions->description : '', route('admin.permissions.show', $permissions));
});

// // Quản lý thành viên
// Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail) {
//     $trail->push('Danh sách thành viên', route('admin.users.index'));
// });

// // Quản lý thành viên > Thông tin thành viên
// Breadcrumbs::for('admin.users.show', function (BreadcrumbTrail $trail, $users) {
//     $trail->parent('admin.users.index');
//     $trail->push($users->name ? $users->name : '', route('admin.users.show', $users));
// });

// //Thông tin tài khoản
// Breadcrumbs::for('edit-profile', function (BreadcrumbTrail $trail) {
//     $trail->push('Thông tin tài khoản', route('edit-profile'));
// });

////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
