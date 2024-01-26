<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\backend\admin\AdminHomeController;
use App\Http\Controllers\backend\admin\AdminClientsController;
use App\Http\Controllers\backend\admin\AdminTrainerController;
use App\Http\Controllers\backend\admin\AdminAuthController;
use App\Http\Controllers\backend\admin\AdminpackageController;

use App\Http\Controllers\backend\trainer\TrainerAuthController;
use App\Http\Controllers\backend\trainer\TrainerClientController;
use App\Http\Controllers\backend\trainer\TrainerSettingsController;
use App\Http\Controllers\backend\trainer\TrainerTimeslotController;

use App\Http\Controllers\backend\client\ClientAuthController;
use App\Http\Controllers\backend\client\ClientDietController;
use App\Http\Controllers\backend\client\ClientWorkoutController;
use App\Http\Controllers\backend\client\ClientSettingsController;





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
        Route::get('trainer/verify-email/{token}', [AdminTrainerController::class, 'trainer_verify_email'])->name('create.trainer_verify');
        Route::post('/re-verify-email', [AdminTrainerController::class, 're_trainer_verify_email'])->name('create.trainer_re_verify');

        //===================================================ADMIN PACKAGE ROUTES========================================================
        
        Route::get('/packages', [AdminpackageController::class, 'view'])->name('view.packages');
        Route::post('/package/add', [AdminpackageController::class, 'add_package'])->name('create.package');

        Route::get('/ajax/getfee', [AdminpackageController::class, 'get_fee'])->name('get.fee');
        Route::get('/package', [AdminpackageController::class, 'list'])->name('view.packagelist');

        Route::get('/package/edit/{id}', [AdminpackageController::class, 'view_edit'])->name('view.package-edit');
        Route::post('/package/edit/{id}', [AdminpackageController::class, 'edit_package'])->name('create.package-edit');

        Route::get('/package/delete/{id}', [AdminpackageController::class, 'delete_package'])->name('create.package-delete');
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

});

// ============================== Trainer routes ================================
Route::prefix('trainer')->group(function()
{
   Route::get('/login',[TrainerAuthController::class,'view_login'])->name('view.trainer-login');
   Route::post('/login',[TrainerAuthController::class,'login'])->name('create.trainer-login');

 
   Route::post('/send-forgot-password-link',[TrainerAuthController::class,'send_link'])->name('create.link');

   Route::get('/reset-password/{token}',[TrainerAuthController::class,'view_reset_password'])->name('view.reset-password');
   Route::post('/reset-password',[TrainerAuthController::class,'reset_password'])->name('create.reset-password');

   Route::middleware(['trainer.auth'])->group(function() 
   {
    Route::get('/dashboard', [TrainerAuthController::class, 'view_dashboard'])->name('view.trainer-dashboard');
    Route::get('/logout', [TrainerAuthController::class, 'logout'])->name('create.trainer-logout');

    Route::get('/my-clients', [TrainerClientController::class, 'my_clients'])->name('view.my-clients');
    Route::get('/my-client/{id}', [TrainerClientController::class, 'get_client'])->name('view.client');

    Route::get('/add-diet/{id}', [TrainerClientController::class, 'add_diet'])->name('create.diet');
    Route::get('/edit-diet/{id}', [TrainerClientController::class, 'view_edit_diet'])->name('view.edit-diet');
    Route::post('/edit-diet/{id}', [TrainerClientController::class, 'edit_diet'])->name('edit.diet');
    Route::get('/delete-diet/{id}', [TrainerClientController::class, 'delete_diet'])->name('delete.diet');

    Route::get('/get-calories', [TrainerClientController::class, 'get_calories'])->name('create.calories');
    Route::post('/save-diet/{id}', [TrainerClientController::class, 'save_diet'])->name('save.diet');

    Route::get('/add-workout/{id}',[TrainerClientController::class,'make_workout'])->name('create.workout');
    Route::post('ajax/add-workout',[TrainerClientController::class,'add_workout'])->name('save.workout');

    Route::get('/edit-workout/{id}',[TrainerClientController::class,'edit_workout'])->name('edit.workout');

    Route::get('/ajax/delete-workout',[TrainerClientController::class,'ajax_delete_workout'])->name('delete.ajax-workout');
    
    Route::get('/my-profile',[TrainerSettingsController::class,'my_profile'])->name('view.my-profile');

    Route::post('/profile-reset-password',[TrainerSettingsController::class,'reset_password'])->name('create.profile-reset-password');
    Route::post('/update-profile',[TrainerSettingsController::class,'update'])->name('create.profile-update');

    Route::get('/timeslots',[TrainerTimeslotController::class,'index'])->name('view.timeslots');
    Route::post('/timeslots',[TrainerTimeslotController::class,'add'])->name('save.timeslots');


    
   });

   
});

// ============================== Client routes ================================
Route::prefix('client')->group(function()
{
   Route::get('/login',[ClientAuthController::class,'view_login'])->name('view.client-login');
   Route::post('/login',[ClientAuthController::class,'login'])->name('create.client-login');

   Route::post('/client-send-forgot-password-link',[ClientAuthController::class,'send_link'])->name('create.client-password-reset-link');

   Route::get('/client-reset-password/{token}',[ClientAuthController::class,'view_reset_password'])->name('view.client-reset-password');
   Route::post('/client-reset-password',[ClientAuthController::class,'reset_password'])->name('create.client-reset-password');


   Route::middleware(['client.auth'])->group(function()
   {
    Route::get('/dashboard',[ClientAuthController::class,'view_dashboard'])->name('view.client-dashboard');
    Route::get('/logout', [ClientAuthController::class, 'logout'])->name('create.client-logout');
    Route::get('/my-diets', [ClientDietController::class, 'view'])->name('view.client-diets');

    Route::get('/my-workout', [ClientWorkoutController::class, 'view'])->name('view.client-workout');
    Route::get('/profile', [ClientSettingsController::class, 'view'])->name('view.client-profile');
    Route::post('/profile', [ClientSettingsController::class, 'update'])->name('create.client-profile-update');

    Route::post('/client-profile-reset-password', [ClientSettingsController::class, 'reset_password'])->name('create.client-password-update');
    
   });
  
});



