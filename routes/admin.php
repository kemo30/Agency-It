<?php

use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\TaskController;

use Illuminate\Support\Facades\Route;

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
Route::group([

    'prefix' => '/dashboard',
    // ISAdmin middleware to making sure authenticated user is admin 
    'middleware' => ['IsAdmin','auth'],

],function(){

    Route::resource('projects',ProjectController::class,[
       
        'index' => 'projects',
        'store' => 'projects.store',
        'create' => 'projects.create',
        'show' => 'projects.show',
        'edit' => 'projects.edit',
        'update' => 'projects.update',
        'destroy' => 'projects.destroy',
      
    ]);
    Route::resource('tasks',TaskController::class,[
       
        'index' => 'tasks',
        'store' => 'tasks.store',
        'create' => 'tasks.create',
        'show' => 'tasks.show',
        'edit' => 'tasks.edit',
        'update' => 'tasks.update',
        'destroy' => 'tasks.destroy',
      
    ]);
    
});


