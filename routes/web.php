<?php

use App\Http\Controllers\employee\taskssController;
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

Route::get('/', function () {
    return view('auth.login');
});



Route::group([
     
    
    'prefix' => '/employee',
    'middleware' => 'auth',

],function(){
// get list of task for auth user only
Route::get('/tasks',[taskssController::class,'index'])->name('tasks');

/* 
  show page 
  tsak parameter to use model binding 
*/
Route::get('/task/{task}',[taskssController::class,'show'])->name('task.show');

//this route to return form page can userve submit tasks 
Route::get('/task/{task}/submit',[taskssController::class,'submitPage'])->name('task.submitPage');

// submit task route 
Route::post('/task/submit',[taskssController::class,'submit'])->name('task.submit');
   
    
});



require __DIR__.'/auth.php';
