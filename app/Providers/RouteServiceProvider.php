<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Define routes with role-based middleware
        Route::middleware('auth')
            ->group(function () {

                // Admin routes
                Route::middleware('role:admin') // Use the role middleware correctly
                    ->group(function () {
                    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
                });

                // Doctor routes
                Route::middleware('role:doctor') // Use the role middleware correctly
                    ->group(function () {
                    Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor.dashboard');
                });

                // Patient routes
                Route::middleware('role:patient') // Use the role middleware correctly
                    ->group(function () {
                    Route::get('/patient', [PatientController::class, 'index'])->name('patient.dashboard');
                });
            });
    }
}
