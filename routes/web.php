<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\ApikeysController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\InstructionController;


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
Route::controller(DashboardController::class)->group(function(){
    Route::get('/','home')->middleware(['verify.shopify','billable'])->name('home');
    Route::post('/get-chart-data','getChartData')->name('get-chart-data');
    Route::post('/all-analytics','getAllAnalytics')->name('all-analytics');
    Route::get('/total-login-registration','totalLogins')->middleware(['verify.shopify','billable'])->name('total-login-registration');
    
});

Route::controller(SettingController::class)->group(function(){
    Route::get('/settings','settingPage')->middleware(['verify.shopify','billable'])->name('settings');
    Route::post('/save-settings','settingSaved')->middleware(['verify.shopify','billable'])->name('save-settings');
    Route::post('/save-modal-settings','modalSettingSave')->middleware(['verify.shopify','billable'])->name('save-modal-settings');
    Route::get('/callback/{provider}','hybridCallback')->name('callback');
});

Route::controller(IntegrationController::class)->group(function(){
    Route::get('/integrations','integrations')->middleware(['verify.shopify','billable'])->name('integrations');
    Route::post('/get-klaviyo-list','getKlaviyoList')->middleware(['verify.shopify','billable'])->name('get-klaviyo-list');
    Route::post('/add-klaviyo-integration','addKlaviyoIntegration')->middleware(['verify.shopify','billable'])->name('add-klaviyo-integration');
    
});
Route::controller(CustomerController::class)->group(function(){
    Route::get('/customers','showCustomers')->middleware(['verify.shopify','billable'])->name('customers');
    Route::get('/create-customer','createCustomer')->name('create-customer');
    Route::get('/customersAjax','customerTableAjax')->name('customersAjax');
    Route::post('/create-magic-link','checkAndCreateMagicLink')->name('create-magic-link');
    Route::post('/google-customer','googlePopupCustomer')->name('google-customer');
    Route::get('/redirect-link','checkValidLink')->name('redirect-link');

});

Route::controller(ApikeysController::class)->group(function(){
    Route::get('/api-key-settings','apikeySettings')->middleware(['verify.shopify','billable'])->name('api-key-settings');
    Route::post('/save-apikeys-settings','saveApiKeysSettings')->middleware(['verify.shopify','billable'])->name('save-apikeys-settings');

});
Route::get('/social-auth',[SocialController::class,'socialAuthentication'])->name('social-auth');
Route::get('/plans',[PlanController::class,'plans'])->middleware(['verify.shopify','billable'])->name('plans');
Route::post('/cancel-plan',[PlanController::class,'cancelPlan'])->name('cancel-plan');

Route::get('/instruction',[InstructionController::class,'instruction'])->middleware(['verify.shopify','billable'])->name('instruction');

