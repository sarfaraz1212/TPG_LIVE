<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\backend\admin\AdminHomeController;
use App\Http\Controllers\backend\admin\AdminClientsController;
use App\Http\Controllers\backend\admin\AdminTrainerController;
use App\Http\Controllers\backend\admin\AdminAuthController;
use App\Http\Controllers\backend\admin\AdminpackageController;


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

// ==============================Frontend routes ================================
Route::get('/',[HomeController::class,'viewhome'])->name('view.home');
Route::get('/about-us',[HomeController::class,'viewaboutus'])->name('view.about');
Route::get('/blog',[HomeController::class,'viewblog'])->name('view.blog');
Route::get('/classes',[HomeController::class,'viewclasses'])->name('view.classes');
Route::get('/contact',[HomeController::class,'viewcontact'])->name('view.contact');
Route::get('/feature',[HomeController::class,'viewfeature'])->name('view.feature');

// ============================== Admin routes ================================
Route::prefix('admin')->group(function()
{

    Route::get('/register',[AdminAuthController::class,'viewregister'])->name('view.register');
    Route::post('/register',[AdminAuthController::class,'register'])->name('create.register');
 
    Route::get('/login',[AdminAuthController::class,'viewlogin'])->name('view.login');
    Route::post('/login',[AdminAuthController::class,'login'])->name('create.login');

    Route::middleware(['admin.auth'])->group(function () 
    {
        //===================================================ADMIN TRAINER ROUTES========================================================
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('create.logout');
        Route::get('/dashboard', [AdminHomeController::class, 'viewdashboard'])->name('view.dashboard');


        Route::get('/add-trainer', [AdminTrainerController::class, 'view_add_trainer'])->name('view.addtrainer');
        Route::post('/add-trainer', [AdminTrainerController::class, 'add_trainer'])->name('create.addtrainer');

        Route::get('/trainer/edit/{id}', [AdminTrainerController::class, 'view_edit_trainer'])->name('view.edit-trainer');
        Route::post('/trainer/edit/{id}', [AdminTrainerController::class, 'edit_trainer'])->name('edit.trainer');

        Route::get('/trainer/delete/image', [AdminTrainerController::class, 'delete_image'])->name('delete.trainer-image');
        Route::get('/trainer/delete/document', [AdminTrainerController::class, 'delete_document'])->name('delete.trainer-document');
        Route::get('/trainer/delete/certificate', [AdminTrainerController::class, 'delete_certificate'])->name('delete.trainer-certificate');

        Route::get('/trainer/delete/{id}', [AdminTrainerController::class, 'delete_trainer'])->name('view.delete-trainer');

        Route::get('/trainers', [AdminTrainerController::class, 'view_trainers_list'])->name('view.trainers_list');
        Route::get('/non-verified/trainers', [AdminTrainerController::class, 'view_non_verfified_trainers'])->name('view.non_verfified_trainers');
        Route::get('/verify-email/{token}', [AdminTrainerController::class, 'trainer_verify_email'])->name('create.trainer_verify');
        Route::post('/re-verify-email', [AdminTrainerController::class, 're_trainer_verify_email'])->name('create.trainer_re_verify');

        //===================================================ADMIN PACKAGE ROUTES========================================================
        
        Route::get('/packages', [AdminpackageController::class, 'view'])->name('view.packages');
        Route::post('/package/add', [AdminpackageController::class, 'add_package'])->name('create.package');

        Route::get('/ajax/getfee', [AdminpackageController::class, 'get_fee'])->name('get.fee');
        Route::get('/package', [AdminpackageController::class, 'list'])->name('view.packagelist');


        //===================================================ADMIN CLIENT ROUTES========================================================
        
        Route::get('/add-client', [AdminClientsController::class, 'view_add_client'])->name('view.addclient');
        Route::post('/add-client', [AdminClientsController::class, 'add_client'])->name('create.addclient');

        Route::get('/client/edit/{id}', [AdminClientsController::class, 'view_edit_client'])->name('view.edit-client');
        Route::post('/client/edit/{id}', [AdminClientsController::class, 'edit_client'])->name('edit.client');

        Route::get('/clients', [AdminClientsController::class, 'view_clients'])->name('view.clients');
        Route::get('/non-verified/clients', [AdminClientsController::class, 'view_non_verfified_clients'])->name('view.non_verfified_clients');
        Route::get('/verify-email/{token}', [AdminClientsController::class, 'client_verify_email'])->name('create.client_verify');

         Route::post('client/re-verify-email', [AdminClientsController::class, 're_verify_client'])->name('create.client_re_verify');

        

    });

//============================== Admin routes ================================


       
    
  
});
