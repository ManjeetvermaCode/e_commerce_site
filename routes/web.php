<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\rolePermissionController;
use App\Http\Controllers\userRoleController;
use App\Http\Controllers\UserController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.dashboard');
})->name('main-dashboard');

Route::get('/admin',function(){
    return 'You are admin';
})->middleware('role:admin');

Route::get('/user',function(){
    return 'You are user';
})->middleware('role:user');

Auth::routes(); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources([
    'roles' => RoleController::class,
    'permissions' => PermissionController::class,
    'user-role'=>userRoleController::class,
    'role-permission'=>rolePermissionController::class,
    'acl-users'=>UserController::class,
]);


// below are testing routes for route middleware
Route::get('/userprofile',function(){
    return 'this is user profile';
})->middleware(['roleName:role_User']);

Route::get('/moderator',function(){
    return 'only access by moderator';
})->middleware(['roleName:role_moderator']);

Route::get('/seller',function(){
    return 'seller route';
})->middleware(['roleName:role_Seller']);

// search and note naming conventions in laravel.
