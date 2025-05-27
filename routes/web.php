<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

   
});
Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');

Route::post('/result', [HomeController::class, 'result'])->name('result');

Route::get('/result/{search_query}', [HomeController::class, 'result_prev'])->name('result_prev');

Route::post('/result_info', [HomeController::class, 'result_info'])->name('result_info');

Route::get('/result_submit/{search_query}/{driver_id}/{dashboard}', [HomeController::class, 'result_submit'])->name('result_submit');

Route::post('/delete_review', [HomeController::class, 'delete_review'])->name('delete_review');

// Route::get("google-auto-complete", "GoogleController@index")->name('search-info');

Route::get('/your_reviews', [DashboardController::class, 'your_reviews'])->name('your_reviews');

Route::post('/update_users', [DashboardController::class, 'update_users'])->name('update_users');

Route::post('/delete_users', [DashboardController::class, 'delete_users'])->name('delete_users');

Route::get('/manage_users', [DashboardController::class, 'manage_users'])->name('manage_users');

Route::post('/search_drivers', [DashboardController::class, 'search_drivers'])->name('search_drivers');

Route::post('/create_driver', [DashboardController::class, 'create_driver'])->name('create_driver');

Route::post('/delete_drivers', [DashboardController::class, 'delete_drivers'])->name('delete_drivers');

Route::get('/manage_drivers/{city}/{search_query}', [DashboardController::class, 'manage_drivers'])->name('manage_drivers');



