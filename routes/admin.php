<?php

use App\Http\Controllers\admin\AdminPanelController;
use App\Http\Controllers\admin\AdminUsersController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\ContactMessagesController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\admin\FAQsController;
use App\Http\Controllers\admin\ClientUsersController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\admin\StaticPagesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'AdminPanel', 'middleware' => ['isAdmin', 'auth']], function () {
    Route::get('/', [AdminPanelController::class, 'index'])->name('admin.index');
    Route::get('/read-all-notifications', [AdminPanelController::class, 'index'])->name('admin.notifications.readAll');
    Route::get('/notification/{id}/details', [AdminPanelController::class, 'notificationDetails'])->name('admin.notification.details');
    Route::get('/my-salary', [AdminPanelController::class, 'mySalary'])->name('admin.mySalary');
    Route::get('/my-profile', [AdminPanelController::class, 'EditProfile'])->name('admin.myProfile');
    Route::post('/my-profile', [AdminPanelController::class, 'UpdateProfile'])->name('admin.myProfile.update');
    Route::get('/my-password', [AdminPanelController::class, 'EditPassword'])->name('admin.myPassword');
    Route::post('/my-password', [AdminPanelController::class, 'UpdatePassword'])->name('admin.myPassword.update');
    Route::get('/notifications-settings', [AdminPanelController::class, 'EditNotificationsSettings'])->name('admin.notificationsSettings');
    Route::post('/notifications-settings', [AdminPanelController::class, 'UpdateNotificationsSettings'])->name('admin.notificationsSettings.update');



    Route::group(['prefix' => 'roles'], function () {
        Route::post('/CreatePermission', [RolesController::class, 'CreatePermission'])->name('admin.CreatePermission');
        Route::get('/', [RolesController::class, 'index'])->name('admin.roles');
        Route::post('/create', [RolesController::class, 'store'])->name('admin.roles.store');
        Route::post('/{id}/edit', [RolesController::class, 'update'])->name('admin.roles.update');
        Route::get('/{id}/delete', [RolesController::class, 'delete'])->name('admin.roles.delete');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', [SettingsController::class, 'generalSettings'])->name('admin.settings.general');
        Route::post('/', [SettingsController::class, 'updateSettings'])->name('admin.settings.update');
        Route::get('/{key}/deletePhoto', [SettingsController::class, 'deleteSettingPhoto'])->name('admin.settings.deletePhoto');
    });


    Route::group(['prefix' => 'staticPages'], function () {
        Route::get('/', [StaticPagesController::class, 'mainPage'])->name('admin.staticPages.general');
        Route::get('/contactUs', [StaticPagesController::class, 'contactUsPage'])->name('admin.staticPages.contactUsPage');
        Route::get('/aboutUs', [StaticPagesController::class, 'aboutUsPage'])->name('admin.staticPages.aboutUsPage');
        Route::post('/update', [StaticPagesController::class, 'updatePages'])->name('admin.staticPages.update');
        Route::get('/{key}/deletePhoto', [StaticPagesController::class, 'deleteSettingPhoto'])->name('admin.staticPages.deletePhoto');
    });


    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', [PagesController::class, 'index'])->name('admin.pages');
        Route::post('/create', [PagesController::class, 'store'])->name('admin.pages.store');
        Route::post('/{id}/edit', [PagesController::class, 'update'])->name('admin.pages.update');
        Route::get('/{id}/delete', [PagesController::class, 'delete'])->name('admin.pages.delete');
    });



});
