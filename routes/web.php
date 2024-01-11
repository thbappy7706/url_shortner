<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within  a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return to_route('login');


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// dashboard routes
Route::prefix('admin')->name('admin.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('remove-favorite/{id}', [HomeController::class, 'removeFavorite'])->name('remove.favorite');
    Route::get('contacts/get-data', [ContactController::class, 'getData']);
    Route::resource('/contacts', ContactController::class);
    Route::resource('users', UserController::class);
    Route::post('/users_password', [UserController::class, 'changePassword'])->name('password.update');
    Route::get('bookmark-contact/{id}', [ContactController::class, 'bookmarkContact'])->name('contact.bookmark');

});
