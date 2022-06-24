<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\CompanyController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group([
    'middleware' => ['auth'],
],function(){

    Route::resource('role',UserManagement\RoleController::class);
    Route::resource('user',UserManagement\UserController::class);
    Route::get('/user/create',[UserManagement\UserController::class,'create'])->name("user.create");
    Route::resource('create-permission',UserManagement\PermissionController::class);
    Route::post('/edit-permission',[UserManagement\PermissionController::class,'EditPermission']);
    Route::post('/delete-permission',[UserManagement\PermissionController::class,'DeletePermission']);

    Route::resource('mapping',UserManagement\RoleUserMappngController::class);

    Route::resource('company',CompanyController::class);
    Route::post('/company/{id}',[CompanyController::class,'update']);


});
