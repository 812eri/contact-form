<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

Route::get('/', [ContactController::class, 'index'])->name('index');
Route::post('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('store');
Route::get('/thanks', function() {
    return view('thanks');
})->name('thanks');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [ContactController::class, 'admin'])->name('admin');
    Route::delete('/admin/delete/{id}', [ContactController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/export', [ContactController::class, 'export'])->name('admin.export');
});