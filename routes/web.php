<?php

use App\Http\Controllers\AccountingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContentPlanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeePortfolioController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PortfolioAdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Multi-Page Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [HomeController::class, 'services'])->name('public.services');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('public.portfolio');
Route::get('/process', [HomeController::class, 'process'])->name('public.process');
Route::get('/about', [HomeController::class, 'process'])->name('public.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('public.contact');
Route::post('/inquiries', [HomeController::class, 'submitInquiry'])->name('inquiries.store');
Route::get('/invoice/receipt/{receipt_number}', [CashierController::class, 'publicReceipt'])->name('public.receipt');

// Admin Panel Access (/admin) & Login
Route::get('/admin', [AuthController::class, 'showLogin'])->name('admin');
Route::post('/admin', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated ERP & Agency Routes (RBAC & Isolation)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // =========================================================================
    // Notifications & PWA Web Push Feeds
    // =========================================================================
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::get('/api/notifications/unread-feed', [NotificationController::class, 'unreadFeed'])->name('notifications.unread-feed');

    // =========================================================================
    // Employee Personal Portfolio
    // =========================================================================
    Route::get('/my-portfolio', [EmployeePortfolioController::class, 'index'])->name('my-portfolio');

    // =========================================================================
    // Daily Tasks Engine, Distribution & Photographer Tracking
    // =========================================================================
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::post('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.status');
    Route::post('/tasks/{task}/deliver', [TaskController::class, 'deliver'])->name('tasks.deliver');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Photographer Field Workflow (GPS & Geofencing Attendance)
    Route::post('/tasks/{task}/photographer/accept', [TaskController::class, 'photographerAccept'])->name('tasks.photographer.accept');
    Route::post('/tasks/{task}/photographer/checkin', [TaskController::class, 'photographerCheckin'])->name('tasks.photographer.checkin');
    Route::post('/tasks/{task}/photographer/deliver', [TaskController::class, 'photographerDeliver'])->name('tasks.photographer.deliver');

    // =========================================================================
    // Projects Engine & Content Creator Workflow (Delivery to GM)
    // =========================================================================
    Route::resource('projects', ProjectController::class);
    Route::post('/projects/{project}/deliver-to-gm', [ProjectController::class, 'deliverToGM'])->name('projects.deliver-to-gm');
    Route::post('/projects/{project}/gm-decision', [ProjectController::class, 'gmDecision'])->name('projects.gm-decision');

    // =========================================================================
    // Clients CRM & Payment Installments
    // =========================================================================
    Route::resource('clients', ClientController::class);
    Route::post('/clients/{client}/installments', [ClientController::class, 'storeInstallment'])->name('clients.installments.store');
    Route::post('/installments/{installment}/pay', [ClientController::class, 'payInstallment'])->name('installments.pay');
    Route::delete('/installments/{installment}', [ClientController::class, 'deleteInstallment'])->name('installments.destroy');

    // =========================================================================
    // Monthly Content Calendar & Publishing Plans (GM & Content Creators Only)
    // =========================================================================
    Route::get('/content-plans', [ContentPlanController::class, 'index'])->name('content-plans.index');
    Route::post('/content-plans', [ContentPlanController::class, 'store'])->name('content-plans.store');
    Route::put('/content-plans/{contentPlan}', [ContentPlanController::class, 'update'])->name('content-plans.update');
    Route::delete('/content-plans/{contentPlan}', [ContentPlanController::class, 'destroy'])->name('content-plans.destroy');
    Route::post('/content-plans/{contentPlan}/toggle-publish', [ContentPlanController::class, 'togglePublish'])->name('content-plans.toggle-publish');

    // =========================================================================
    // Agency Cashier & Quick Billing
    // =========================================================================
    Route::get('/cashier', [CashierController::class, 'index'])->name('cashier.index');
    Route::post('/cashier/payment', [CashierController::class, 'store'])->name('cashier.payment');
    Route::post('/cashier/quick-client', [CashierController::class, 'quickCreateClient'])->name('cashier.quick-client');
    Route::get('/cashier/receipt/{payment}', [CashierController::class, 'receipt'])->name('cashier.receipt');
    Route::get('/cashier/settlement', [CashierController::class, 'settlement'])->name('cashier.settlement');

    // =========================================================================
    // Detailed Corporate Accounting System (نظام الحسابات المتكامل للشركة)
    // =========================================================================
    Route::get('/accounting', [AccountingController::class, 'index'])->name('accounting.index');
    Route::post('/accounting/transactions', [AccountingController::class, 'storeTransaction'])->name('accounting.transactions.store');
    Route::post('/accounting/treasuries', [AccountingController::class, 'storeTreasury'])->name('accounting.treasuries.store');
    Route::post('/accounting/categories', [AccountingController::class, 'storeCategory'])->name('accounting.categories.store');
    Route::get('/accounting/reports', [AccountingController::class, 'reports'])->name('accounting.reports');
    Route::get('/accounting/export-excel', [AccountingController::class, 'exportExcel'])->name('accounting.export-excel');

    // Expenses Legacy / Quick
    Route::resource('expenses', ExpenseController::class)->only(['index', 'store', 'destroy']);

    // CMS & Website Portfolio Management
    Route::get('/cms', [PortfolioAdminController::class, 'index'])->name('cms.index');
    Route::post('/cms/services', [PortfolioAdminController::class, 'storeService'])->name('cms.services.store');
    Route::put('/cms/services/{service}', [PortfolioAdminController::class, 'updateService'])->name('cms.services.update');
    Route::delete('/cms/services/{service}', [PortfolioAdminController::class, 'destroyService'])->name('cms.services.destroy');
    Route::post('/cms/portfolio', [PortfolioAdminController::class, 'storePortfolioItem'])->name('cms.portfolio.store');
    Route::put('/cms/portfolio/{portfolioItem}', [PortfolioAdminController::class, 'updatePortfolioItem'])->name('cms.portfolio.update');
    Route::delete('/cms/portfolio/{portfolioItem}', [PortfolioAdminController::class, 'destroyPortfolioItem'])->name('cms.portfolio.destroy');
    Route::post('/cms/inquiries/{inquiry}/status', [PortfolioAdminController::class, 'updateInquiryStatus'])->name('cms.inquiries.status');

    // Partners & Testimonials CMS Management
    Route::post('/cms/partners', [PortfolioAdminController::class, 'storePartner'])->name('cms.partners.store');
    Route::put('/cms/partners/{partner}', [PortfolioAdminController::class, 'updatePartner'])->name('cms.partners.update');
    Route::delete('/cms/partners/{partner}', [PortfolioAdminController::class, 'destroyPartner'])->name('cms.partners.destroy');
    Route::post('/cms/testimonials', [PortfolioAdminController::class, 'storeTestimonial'])->name('cms.testimonials.store');
    Route::put('/cms/testimonials/{testimonial}', [PortfolioAdminController::class, 'updateTestimonial'])->name('cms.testimonials.update');
    Route::delete('/cms/testimonials/{testimonial}', [PortfolioAdminController::class, 'destroyTestimonial'])->name('cms.testimonials.destroy');

    // Platform Stats CMS Management
    Route::post('/cms/stats', [PortfolioAdminController::class, 'updateStats'])->name('cms.stats.update');

    // Team Members (من نحن) CMS Management
    Route::post('/cms/team-members', [PortfolioAdminController::class, 'storeTeamMember'])->name('cms.team-members.store');
    Route::put('/cms/team-members/{teamMember}', [PortfolioAdminController::class, 'updateTeamMember'])->name('cms.team-members.update');
    Route::delete('/cms/team-members/{teamMember}', [PortfolioAdminController::class, 'destroyTeamMember'])->name('cms.team-members.destroy');

    // Users & Roles Management
    Route::resource('users', UserController::class);
});
