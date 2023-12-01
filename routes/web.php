<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/dashboard', function(){
//     return view('dashboard');
// });

// Route::get('/api/users',[UsersController::class,'index']);
// Route::post('/api/users',[UsersController::class,'store']);

Route::match(['get','post'],'/api/users',[UsersController::class,'index_create']);

Route::get('{view}',ApplicationController::class)->where('view','(.*)');
