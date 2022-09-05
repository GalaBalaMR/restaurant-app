<?php

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Frontend\MailController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\ContentController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Frontend\ReservationController as FrontendReservationController;

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

Route::get('/', [WelcomeController::class , 'index'])->name('welcome.index');

Route::get('/user', [UserController::class , 'show'])->middleware(['auth'])->name('user.index');

Route::post('/email', [MailController::class , 'index'])->name('email.index');

Route::post('/search-menu', [MenuController::class , 'search'])->name('menu.search');

Route::get('/reservation/step-one', [FrontendReservationController::class , 'stepOne'])->name('reservations.step.one');
Route::post('/reservation/step-one', [FrontendReservationController::class , 'storeStepOne'])->name('reservations.store.step.one');
Route::get('/reservation/step-two', [FrontendReservationController::class , 'stepTwo'])->name('reservations.step.two'); 
Route::middleware(['role:Admin'])->group(function () {// for making content, middleware for admin
    Route::resource('/contents', ContentController::class);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// admin things,
// for role admin, manager, waiter,
// some restriction is in admin.blade(e. g. not show waiter)
Route::middleware(['role:Admin|Waiter|Manager'])->name('admin.')->prefix('admin')->group(function() {
    Route::get('/' , [AdminController::class, 'index'])->name('index');
    Route::resource('/users' , UserController::class);
    Route::resource('/categories' , CategoryController::class);
    Route::resource('/menus' , MenuController::class);
    Route::resource('/tables' , TableController::class);
    Route::resource('/reservations' , ReservationController::class);

});

require __DIR__.'/auth.php';
