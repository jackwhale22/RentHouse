<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\HomeController;

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

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/browse', [HomeController::class, 'publicSearch'])->name('public.search');
Route::get('/kos-detail/{id}', [HomeController::class, 'showKos'])->name('public.kos.show');

// Route untuk mengakses file uploads
Route::get('uploads/{path}', function($path) {
    return response()->file(public_path("uploads/{$path}"));
})->where('path', '.*');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('users.delete');

    // Kos verification routes
    Route::get('/verify-kos', [AdminController::class, 'verifyKos'])->name('verify-kos');
    Route::post('/kos/{id}/approve', [AdminController::class, 'approveKos'])->name('kos.approve');
    Route::delete('/kos/{id}/reject', [AdminController::class, 'rejectKos'])->name('kos.reject');

    // Verification report routes - MUST come BEFORE dynamic {id} routes
    Route::get('/verification/report', [AdminController::class, 'verificationReport'])->name('verification.report');
    Route::post('/verification/print-report', [AdminController::class, 'printVerificationReport'])->name('verification.print-report');
    Route::get('/verification/export-pdf', [AdminController::class, 'exportVerificationPDF'])->name('verification.export-pdf');
    Route::get('/verification/export-excel', [AdminController::class, 'exportVerificationExcel'])->name('verification.export-excel');

    // Kos details route - specific route before dynamic ones
    Route::get('/kos/{id}/details', [AdminController::class, 'getKosDetails'])->name('kos.details');
});

// Pemilik routes
Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard', [PemilikController::class, 'dashboard'])->name('dashboard');
    Route::get('/my-kos', [PemilikController::class, 'myKos'])->name('my-kos');
    Route::get('/kos/create', [PemilikController::class, 'createKos'])->name('kos.create');
    Route::post('/kos', [PemilikController::class, 'storeKos'])->name('kos.store');
    Route::get('/kos/{id}/edit', [PemilikController::class, 'editKos'])->name('kos.edit');
    Route::put('/kos/{id}', [PemilikController::class, 'updateKos'])->name('kos.update');
    Route::delete('/kos/{id}', [PemilikController::class, 'deleteKos'])->name('pemilik.kos.delete');

    // Message management routes
    Route::get('/messages', [PemilikController::class, 'messages'])->name('messages');

    // MOVE REPORT ROUTES BEFORE DYNAMIC {id} ROUTES
    Route::get('/messages/report', [PemilikController::class, 'messagesReport'])->name('messages.report');
    Route::post('/messages/print-report', [PemilikController::class, 'printMessagesReport'])->name('messages.print-report');
    Route::get('/messages/export-pdf', [PemilikController::class, 'exportMessagesPDF'])->name('messages.export-pdf');
    Route::get('/messages/export-excel', [PemilikController::class, 'exportMessagesExcel'])->name('messages.export-excel');

    // Dynamic routes should come AFTER specific routes
    Route::get('/messages/{id}', [PemilikController::class, 'messageDetail'])->name('messages.detail');
    Route::post('/messages/{id}/status', [PemilikController::class, 'updateContactStatus'])->name('messages.status');
    Route::post("/messages/{id}/reply", [PemilikController::class, "replyMessage"])->name("messages.reply");
    Route::post("/messages/{id}/update-transaksi-status", [PemilikController::class, "updateTransaksiStatus"])->name("messages.update-transaksi-status");
});

// Penyewa routes
Route::middleware(["auth", "role:penyewa"])->group(function () {
    Route::get("/dashboard", [PenyewaController::class, "dashboard"])->name("dashboard");
    Route::get("/search", [PenyewaController::class, "searchKos"])->name("search");
    Route::get("/kos/{id}", [PenyewaController::class, "showKos"])->name("kos.show");
    Route::post("/kos/{id}/contact", [PenyewaController::class, "contactPemilik"])->name("kos.contact");
    Route::get("/my-transaksi", [PenyewaController::class, "myTransaksi"])->name("my-transaksi");
    Route::post("/transaksi/{id}/cancel", [PenyewaController::class, "cancelTransaksi"])->name("transaksi.cancel");

    // Message management routes for Penyewa
    Route::get("/my-messages", [PenyewaController::class, "myMessages"])->name("my-messages");
    Route::get("/my-messages/{id}", [PenyewaController::class, "messageDetail"])->name("my-messages.detail");
    Route::post("/my-messages/{id}/reply", [PenyewaController::class, "replyToPemilik"])->name("my-messages.reply");
});

// Shared authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});
