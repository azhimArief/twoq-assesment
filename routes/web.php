<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('auth/login');
});

// Route::get('/companies', function () {
//     return view('companies');
// })->middleware(['auth', 'verified'])->name('companies');

Route::get('/companies', [CompanyController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('companies');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Crud Companies
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('/companies/store', [CompanyController::class, 'store'])->name('company.store');
    Route::get('/companies/delete/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');
    Route::get('/companies/edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
    Route::put('/companies/update/{company}', [CompanyController::class, 'update'])->name('company.update');

});

require __DIR__.'/auth.php';
