<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Registration routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('post.register');

// Login routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/doctor/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/doctor/post_settings/{id}', [AdminController::class, 'post_settings'])->name('post_settings');
    Route::post('/appointments/approve/{appointmentId}', [AppointmentController::class, 'approveAppointment'])->name('appointments.approve');
    Route::post('/appointments/cancel/{appointmentId}', [AppointmentController::class, 'cancelAppointment'])->name('appointments.cancel');
    Route::get('/all_doctors', [AdminController::class, 'all_doctors'])->name('all_doctors');
    Route::get('/all_patients', [AdminController::class, 'all_patients'])->name('all_patients');
    Route::put('/admin/update-role/{user}', [AdminController::class, 'updateRole'])->name('admin.updateRole');
    Route::put('/admin/block-user/{user}', [AdminController::class, 'blockUser'])->name('admin.blockUser');
});

// Doctor routes
Route::middleware(['auth', 'role:doctor|admin'])->group(function () {
    Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor');
    Route::get('/doctor/settings', [DoctorController::class, 'settings'])->name('settings');
    Route::post('/doctor/post_settings/{id}', [DoctorController::class, 'post_settings'])->name('post_settings');
    Route::post('/appointments/approve/{appointmentId}', [AppointmentController::class, 'approveAppointment'])->name('appointments.approve');
    Route::post('/appointments/cancel/{appointmentId}', [AppointmentController::class, 'cancelAppointment'])->name('appointments.cancel');
    Route::get('/appointments', [DoctorController::class, 'appointment'])->name('appointments');
});

// Patient routes
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient', [PatientController::class, 'index'])->name('home');
    Route::get('/patient/setting', [PatientController::class, 'p_settings'])->name('p_settings');
    Route::post('/patient/post_settings/{id}', [PatientController::class, 'p_post_settings'])->name('post_p_settings');
    Route::get('/doctor/list', [PatientController::class, 'doctor'])->name('patient_doctor');
    Route::get('/patient/booking/{id}', [PatientController::class, 'booking'])->name('booking');
    Route::post('/appointments/request/{doctorId}', [AppointmentController::class, 'requestAppointment'])->name('appointments.request');
    Route::get('/appointments/detail/{id}', [PatientController::class, 'booking_detail'])->name('appointments_detail');
    Route::get('/patient/appointment/{id}', [PatientController::class, 'appointment_detail'])->name('patient_appointment');
    Route::post('/appointments/cancel/{appointmentId}', [PatientController::class, 'cancelAppointment'])->name('appointments.cancel');
    Route::get('/patient/about', [PatientController::class, 'about'])->name('patient_about');
});

// Unauthorized route
Route::get('/unauthorized', function () {
    return 'You are not authorized to access this page';
});
