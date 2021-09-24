<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DispositionController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\PengelolaController;
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
    return view('welcome');
});

// Route::get('/surat', [SuratController::class, 'index'])->middleware('guest')->name('surat');
// Route::post('/upload', [SuratController::class, 'upload'])->middleware('guest')->name('surat.upload');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('inbox', InboxController::class);
    Route::resource('disposition', DispositionController::class);
    Route::post('/upload', [InboxController::class, 'upload'])->name('inbox.upload');
    Route::get('/download/{id}', [InboxController::class, 'downloadPath'])->name('inbox.download');
    Route::delete('/removePath/{id}', [InboxController::class, 'removePath'])->name('inbox.removePath');
    Route::get('/updateWithAjax/{id}', [InboxController::class, 'updateEditAccess'])->name('inbox.updateWithAjax');
});
Route::group(['prefix' => 'pengelola', 'middleware' => ['auth', 'isPengelola']], function () {
    Route::get('/', [PengelolaController::class, 'index'])->name('pengelola.dashboard');
});

require __DIR__ . '/auth.php';
