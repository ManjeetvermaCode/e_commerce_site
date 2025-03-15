<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;


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
});

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
]);