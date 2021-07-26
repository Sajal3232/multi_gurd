<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Admin\Auth\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware('auth:web')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware('guest')->group(function(){
    Route::get('/' , [Auth\AuthController::class, 'login_form'] ) ;
});

Route::middleware('guest')->group(function(){
   
});

Route::prefix('admin')->group(function(){
   Route::name('admin.')->group(function(){
       Route::get('/login' , [LoginController::class, 'showLoginForm'] )->name('login');
       Route::post('/login' , [LoginController::class, 'login'] )->name('login.post');
       Route::get('/logout' , [LoginController::class, 'logout'] )->name('logout');

       Route::middleware('auth:admin')->group(function(){
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::get('/logout' , [LoginController::class, 'logout'] )->name('logout');

        });
   });
});
