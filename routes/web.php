<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Log\LogController;
use App\Http\Controllers\Page\BeneficiaryController;
use App\Http\Controllers\Page\CaseController;
use App\Http\Controllers\Page\GenerateReport;
use App\Http\Controllers\Page\PostAnnouncement;
use App\Http\Controllers\Page\ServiceController;
use Illuminate\Support\Facades\Route;

// Login Routes
Route::get('/', [LoginController::class, 'index'])->name('login.page');
Route::post('/MSWDO/Login', [LoginController::class, 'login'])->name('mswd.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Google Routes
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Beneficiary Routes
Route::post('/Beneficiary/store', [BeneficiaryController::class, 'store']);
Route::get('/Beneficiaries/{id}', [BeneficiaryController::class, 'show'])->name('beneficiaries.show');
Route::put('/Beneficiary/update/{id}', [BeneficiaryController::class, 'update']);
Route::post('/Beneficiary/add-service', [BeneficiaryController::class, 'addService']);
Route::get('/Beneficiaries/{id}/filtered-services', [BeneficiaryController::class, 'getFilteredServices']);
Route::get('/Beneficiaries/search', [BeneficiaryController::class, 'search'])->name('beneficiaries.search');
Route::get('/getBarangayData', [DashboardController::class, 'getBarangayData']);
Route::get('/getBeneficiaryTableData', [LogController::class, 'getBeneficiaryTableData']);


// Case Management Routes
Route::post('/Beneficiary/Case-Management/store', [CaseController::class, 'intakestore']);
Route::post('/Beneficiary/Case-Management/Interview/store', [CaseController::class, 'interviewstore']);

// Generate Reports Routes
Route::get('/generate-report/filter', [GenerateReport::class, 'filterReport'])->name('report.filter');


Route::middleware(['role:admin'])->group(function () {
    Route::get('/Dashboard/Admin', [DashboardController::class, 'admin_index'])->name('admin.dashboard');
});

Route::middleware(['role:personnel'])->group(function () {
    Route::get('/Dashboard/Personnel', [DashboardController::class, 'personnel_index'])->name('personnel.dashboard');
    Route::get('/Page/Beneficiary', [BeneficiaryController::class, 'index'])->name('beneficiary.page');
    Route::get('/Page/Beneficiary/CaseManagement', [CaseController::class, 'index'])->name('casemanage.page');
    Route::get('/Sub-page/Beneficiary/Intake-Form', [CaseController::class, 'intakeform'])->name('intake.form');
    Route::get('/Sub-page/Beneficiary/Interview-Form', [CaseController::class, 'interviewform'])->name('interview.form');
    Route::get('/Page/Beneficiary/Generate-Reports', [GenerateReport::class, 'index'])->name('generate.report');
    Route::get('/Page/Beneficiary/Logs', [LogController::class, 'index'])->name('beneficiary.logs');
    Route::get('/Page/Beneficiary/Post-Announcement', [PostAnnouncement::class, 'index'])->name('post.announcement');
});
