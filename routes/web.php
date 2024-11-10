<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\HotelsController;
use App\Http\Controllers\Admin\RoomsController;
use Illuminate\Support\Facades\Auth;
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
});

Auth::routes();
// to approve or reject  the hotel
// Route::post('/hotel/approve/{id}', [HotelsController::class, 'approveHotel'])->name('hotel.approve');

Route::resource('hotel',HotelsController::class);
Route::resource('category',CategoriesController::class);
Route::resource('room',RoomsController::class);

Route::get('hotels/{hotel}/{status}', [HotelsController::class, 'updateHotelStatus'])->name('hotel.status');
Route::post('hotels/reject/{id}', [HotelsController::class, 'updateRejectMessage'])->name('hotel.reject');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
