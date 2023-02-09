<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\SalespersonController;
use App\Http\Controllers\TestimonialController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('submissions/export/', [CampaignController::class, 'export'])->name('submissions.export');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); 
    Route::resource('homepage', HomepageController::class);
    Route::resource('salesperson', SalespersonController::class);
    Route::resource('testimonial', TestimonialController::class);
    Route::resource('campaign', CampaignController::class)->except('show');

});

require __DIR__.'/auth.php';
    
    Route::post('campaign/form/{homepage}', [CampaignController::class, 'postForm'])->name('campaign.form');
    
    //always last
    Route::get('/{status?}', [CampaignController::class, 'show'])->name('campaign.show');


