<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Log\LogController;
use App\Http\Controllers\Page\BeneficiaryController;
use App\Http\Controllers\Page\BeneficiarySite;
use App\Http\Controllers\Page\CaseController;
use App\Http\Controllers\Page\GenerateReport;
use App\Http\Controllers\Page\PostAnnouncement;
use App\Http\Controllers\Page\ServiceController;
use App\Http\Controllers\Page\UserAccountController;
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

// Beneficiary Site
Route::get('/Beneficiary', [BeneficiarySite::class, 'index'])->name('beneficiary.site');


// Case Management Routes
Route::post('/Beneficiary/Case-Management/store', [CaseController::class, 'intakestore']);
Route::post('/Beneficiary/Case-Management/Interview/store', [CaseController::class, 'interviewstore']);

// Generate Reports Routes
Route::get('/generate-report/filter', [GenerateReport::class, 'filterReport'])->name('report.filter');

// Announcement Routes
Route::post('/post-announcement', [PostAnnouncement::class, 'store'])->name('announcement.store');


Route::middleware(['role:admin,personnel'])->group(function () {
    // Shared routes for admin and personnel
    Route::get('/Page/Beneficiary', [BeneficiaryController::class, 'index'])->name('beneficiary.page');
    Route::get('/Page/Beneficiary/CaseManagement', [CaseController::class, 'index'])->name('casemanage.page');
    Route::get('/Page/Beneficiary/Post-Announcement', [PostAnnouncement::class, 'index'])->name('post.announcement');
    Route::get('/Page/Beneficiary/Generate-Reports', [GenerateReport::class, 'index'])->name('generate.report');
    Route::get('/Sub-page/Beneficiary/Intake-Form', [CaseController::class, 'intakeform'])->name('intake.form');
    Route::get('/Sub-page/Beneficiary/Interview-Form', [CaseController::class, 'interviewform'])->name('interview.form');
    Route::get('/Page/Beneficiary/Logs', [LogController::class, 'index'])->name('beneficiary.logs');
});

Route::middleware(['role:admin'])->group(function () {
    // Admin-specific routes
    Route::get('/Admin/User-Accounts', [UserAccountController::class, 'index'])->name('user.account');
    Route::get('/Dashboard/Admin', [DashboardController::class, 'admin_index'])->name('admin.dashboard');
});

Route::middleware(['role:personnel'])->group(function () {
    // Personnel-specific routes
    Route::get('/Dashboard/Personnel', [DashboardController::class, 'personnel_index'])->name('personnel.dashboard');
});
