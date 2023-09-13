<?php

use App\Http\Controllers\backoffice\AdminController;
use App\Http\Controllers\view\BackController;
use App\Http\Controllers\view\FrontController;
use Illuminate\Support\Facades\Route;

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

/* views */
Route::get('/', [FrontController::class, 'getHome'])->name('home');
Route::get('/facilities', [FrontController::class, 'facilitiesPage'])->name('facilities');
Route::get('/about', [FrontController::class, 'aboutPage'])->name('about');
Route::get('/contactus', [FrontController::class, 'contactPage'])->name('contactus');
Route::get('/rooms', [FrontController::class, 'roomPage'])->name('rooms');

/* Controllers */


/* Route middleware users */
Route::middleware('auth:web')->group(function () {

});


Route::prefix('admin')->group(function () {
    /* Views */
    Route::get('/', [BackController::class, 'loginPage'])->name('admin-login');

    /* Controllers */
    Route::get('/signin', [AdminController::class, 'signIn'])->name('signin');


    /* Route middleware admin */
    Route::middleware('auth:admin')->group(function () {

    });
});
