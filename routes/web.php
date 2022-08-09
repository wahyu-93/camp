<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('payment/success', [CheckoutController::class, 'midtransCallback']);
Route::post('payment/success', [CheckoutController::class, 'midtransCallback']);

Route::middleware(['auth'])->group(function(){
    Route::get('checkout/{camp}', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('checkout/{camp}', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::prefix('user/dashboard')->name('user.')->group(function(){
        Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard');
    });

    Route::prefix('admin')->name('admin.')->group(function(){
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::patch('/{checkout}/update', [AdminDashboardController::class, 'updatePaid'])->name('update.paid');

        // discount
        Route::resource('discount', DiscountController::class);        
    });

    Route::prefix('profile')->name('profile.')->group(function(){
        Route::get('/edit', [BiodataController::class, 'edit'])->name('edit');
        Route::put('/update/{user}', [BiodataController::class, 'update'])->name('update');
        Route::put('updatePassword', [BiodataController::class, 'updatePassword'])->name('update.password');
    });
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
