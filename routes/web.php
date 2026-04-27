<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// ─── Gateway Routes ────────────────────────────────────────────
Route::get('/verify-human', [GatewayController::class, 'index'])->name('gateway.index');
Route::post('/verify-human', [GatewayController::class, 'verify'])->name('gateway.verify')->middleware('throttle:5,1');

// ─── Public Routes ─────────────────────────────────────────────
Route::middleware([\App\Http\Middleware\GuestGateway::class])->group(function () {
    Route::get('/', [PageController::class, 'index'])->name('home');
    Route::get('/projects', [PageController::class, 'projectsArchive'])->name('projects.archive');
    Route::get('/experiences', [PageController::class, 'experiencesArchive'])->name('experiences.archive');
    Route::get('/certificates', [PageController::class, 'certificatesArchive'])->name('certificates.archive');
    Route::get('/activities', [PageController::class, 'activitiesArchive'])->name('activities.archive');
    Route::get('/project/{slug}', [PageController::class, 'projectDetail'])->name('project.detail');
    Route::post('/contact', [PageController::class, 'sendMessage'])->name('contact.send');
});

// ─── Auth Routes (Hidden) ──────────────────────────────────────
Route::get('/adminlogin', [AuthController::class, 'showLogin'])->name('login');
Route::post('/adminlogin', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─── Admin Routes ──────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile (edit-only)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Resource routes
    Route::resource('projects', ProjectController::class)->except(['show']);
    Route::patch('/projects/{project}/toggle-publish', [ProjectController::class, 'togglePublish'])->name('projects.toggle-publish');

    Route::resource('skills', SkillController::class)->except(['show']);
    Route::resource('certificates', CertificateController::class)->except(['show']);
    Route::resource('experiences', ExperienceController::class)->except(['show']);
    Route::resource('activities', ActivityController::class)->except(['show']);

    // Messages (read-only + delete)
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});
