<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth', 'role:admin,company-owner'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [DashboardController::class, "index"])->middleware(['verified'])->name('dashboard');

    // Job applicatio
    Route::resource('job-application', JobApplicationController::class);
    Route::put('job-application/{id}/restore', [JobApplicationController::class, "restore"])->name("job-application.restore");


    // Job vacancy
    Route::resource('job-vacancy', JobVacancyController::class);
    Route::put('job-vacancy/{id}/restore', [JobVacancyController::class, "restore"])->name("job-vacancy.restore");



});

Route::middleware(['auth', 'role:company-owner'])->group(function () {
    Route::get('my-company', [CompanyController::class,'show'])->name('my-company.show');
    Route::get('my-company/edit', [CompanyController::class,'edit'])->name('my-company.edit');
    Route::put('my-company', [CompanyController::class,'update'])->name('my-company.update');




});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Company
    Route::resource('company', CompanyController::class);
    Route::put('company/{id}/restore', [CompanyController::class, "restore"])->name("company.restore");

    // Job category
    Route::resource('job-category', JobCategoryController::class);
    Route::put('job-category/{id}/restore', [JobCategoryController::class, "restore"])->name("job-category.restore");

    // User
    Route::resource('user', UserController::class);
    Route::put('user/{id}/restore', [UserController::class, "restore"])->name("user.restore");
});




require __DIR__ . '/auth.php';
