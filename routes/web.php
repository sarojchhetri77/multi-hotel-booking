<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\HotelManageController;
use App\Http\Controllers\Admin\HotelsController;
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Controllers\Frontend\HomesController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[HomesController::class,'index'])->name('frontend.home');
Route::get('hotel/list',[HomesController::class,'listHotels'])->name('hotel.list');
Auth::routes();
// to manage the hotel 
Route::get('hotel/manage',[HotelManageController::class,'index'])->name('manage.hotel');

Route::resource('hotel',HotelsController::class);
Route::resource('category',CategoriesController::class);
Route::resource('room',RoomsController::class);

Route::get('hotels/{hotel}/{status}', [HotelsController::class, 'updateHotelStatus'])->name('hotel.status');
Route::post('hotels/reject/{id}', [HotelsController::class, 'updateRejectMessage'])->name('hotel.reject');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
