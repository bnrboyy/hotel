<?php

use App\Http\Controllers\backoffice\AdminController;
use App\Http\Controllers\backoffice\CarouselController;
use App\Http\Controllers\backoffice\FeatureAndFacController;
use App\Http\Controllers\backoffice\SettingController;
use App\Http\Controllers\frontoffice\LeaveMessageController;
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
    Route::get('/', [BackController::class, 'adminPage'])->name('admin-login');

    /* Controllers */
    Route::post('/signin', [AdminController::class, 'signIn']);
    Route::post('/register', [AdminController::class, 'register']);


    /* Route middleware admin */
    Route::middleware('auth-admin:admin')->group(function () {
        /* Views */
        // Route::get('/dashboard', [BackController::class, 'dashboardPage'])->name('dashboard');

        /* Controllers */
        Route::get('/logout', [AdminController::class, 'onLogout']);
        Route::post('/updatesite', [SettingController::class, 'onUpdateSite']);
        Route::post('/updateshutdown', [SettingController::class, 'onUpdateShutdown']);
        Route::post('/updatecontact', [SettingController::class, 'onUpdateContact']);

        Route::get('/getcontact', [SettingController::class, 'getContact']);

        Route::get('/carousel/{id}', [CarouselController::class, 'getById']);
        Route::post('/carousel/create', [CarouselController::class, 'create']);
        Route::post('/carousel/update', [CarouselController::class, 'update']);
        Route::delete('/carousel/delete', [CarouselController::class, 'delete']);

        Route::post('/leavemessage', [LeaveMessageController::class, 'createMessage']);
        Route::get('/messageone/{msg_id}', [LeaveMessageController::class, 'getMessageById']);
        Route::delete('/message/delete/{msg_id}', [LeaveMessageController::class, 'deleteMessage']);

        /* Feature & Facilities */
        Route::post('/feature/create', [FeatureAndFacController::class, 'createFeature']);
        Route::get('/featureone/{id}', [FeatureAndFacController::class, 'getFeatureById']);
        Route::post('/feature/update', [FeatureAndFacController::class, 'updateFeature']);

        Route::post('/fac/create', [FeatureAndFacController::class, 'createFac']);
        Route::get('/facone/{id}', [FeatureAndFacController::class, 'getFacById']);

        Route::patch('/updatefacdisplay/{id}', [FeatureAndFacController::class, 'updateFacDisplay']);
        Route::patch('/updatefeaturedisplay/{id}', [FeatureAndFacController::class, 'updateFeatureDisplay']);
        Route::delete('/deletefac/{id}', [FeatureAndFacController::class, 'deleteFac']);
        Route::delete('/deletefeature/{id}', [FeatureAndFacController::class, 'deleteFeature']);
    });
});
