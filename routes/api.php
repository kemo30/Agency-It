<?php

use App\Http\Controllers\api\admin\projectSController;
use App\Http\Controllers\api\admin\tasksController;
use App\Http\Controllers\api\authTokensController;
use App\Http\Controllers\api\employee\taskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// admin route 
// using IsAdmin middleware to making sure authenticated user is admin 
Route::group(['middleware' => ['auth:sanctum','IsAdmin']],function(){
    Route::apiResource('project', projectSController::class);
    Route::apiResource('task', tasksController::class);
});


// employee routes
Route::group(['middleware' => 'auth:sanctum'],function(){
    route::get('/employee/tasks',[taskController::class,'index']);
    route::get('/employee/tasks/{task}',[taskController::class,'show']);
    route::put('/employee/tasks/{task}',[taskController::class,'update']);

});


//login api create token
Route::post('auth/tokens',[authTokensController::class,'store']);
