<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CutiLainnyaController;
use App\Http\Controllers\CutiTahunanController;
use App\Http\Controllers\admin\CutiListController;
use App\Http\Controllers\admin\ListUserController;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/guru/home', [HomeController::class, 'index'])->name('home');
Route::get('/cuti', [CutiController::class, 'index'])->name('cuti');
Route::post('/cuti', [CutiController::class, 'addCuti'])->name('cuti.add');
Route::get('/category', [CutiController::class, 'category'])->name('category');
Route::get('/guru/history', [CutiController::class, 'history'])->name('guru.history');
Route::get('/guru/cuti-tahunan', [CutiTahunanController::class, 'index'])->name('guru.cuti-tahunan');
Route::post('/guru/cuti-tahunan', [CutiTahunanController::class, 'cutiTahunan'])->name('guru.cutitahunan');

Route::get('/guru/cuti-lainnya', [CutiLainnyaController::class, 'index'])->name('guru.cuti-lainnya');
Route::post('/guru/cuti-lainnya', [CutiLainnyaController::class, 'cutiLainnya'])->name('guru.cutilainnya');

Route::get('/admin/list-cuti', [CutiListController::class, 'index'])->name('admin.list-cuti');
Route::post('/leave-requests/{request}/approve', [CutiListController::class, 'approve'])->name('leave-requests.approve');
Route::post('/leave-requests/{request}/disapprove', [CutiListController::class, 'disapprove'])->name('leave-requests.disapprove');

Route::get('/admin/list-user', [ListUserController::class, 'listUser'])->name('admin.list-user');
Route::get('/admin/add-user', [ListUserController::class, 'addUser'])->name('admin.add-user');
Route::post('/admin/add-user', [ListUserController::class, 'storeUser'])->name('admin.store-user');
Route::get('/admin/edit-user/{id}/', [ListUserController::class, 'editUser'])->name('admin.edit-user');
Route::post('/admin/edit-user/{id}/', [ListUserController::class, 'updateUser'])->name('admin.update-user');
Route::get('/admin/list-user/{id}/delete', [ListUserController::class, 'deleteUser'])->name('admin.delete-user');

Route::get('/settings', [UserController::class, 'index'])->name('settings');
Route::post('/settings', [UserController::class, 'pengaturan'])->name('settings.update');

Route::get('guru/history/pdf', [CutiController::class, 'createPDF'])->name('guru.history.pdf');
Route::get('/download-pdf/{id}', [CutiTahunanController::class, 'downloadPDFCuti'])->name('download-pdf');

// mark as read
Route::get('/markAsRead', [CutiTahunanController::class, 'markAsRead'])->name('markAsRead');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
