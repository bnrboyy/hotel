<?php

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

Route::get('/', [FrontController::class, 'getHome'])->name('home');
Route::get('/facilities', [FrontController::class, 'facilitiesPage'])->name('facilities');
Route::get('/about', [FrontController::class, 'aboutPage'])->name('about');
