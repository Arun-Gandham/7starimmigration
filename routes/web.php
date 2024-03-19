<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PaymentHistoryController;
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

Route::get('/map', [MapController::class, 'view'])->name('map');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.submit');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.submit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'Home'])->name('dashboard');

    //Admins

    Route::get('/admins', [AdminController::class, 'List'])->name('admin.list');

    Route::get('/admins/add', [AdminController::class, 'add'])->name('admin.add');

    Route::post('/admins/add/submit', [AdminController::class, 'addSubmit'])->name('admin.add.submit');

    Route::get('/admins/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');

    Route::post('/admins/edit/submit', [AdminController::class, 'editSubmit'])->name('admin.edit.submit');

    Route::get('/admins/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

    Route::get('/admins/datatables', [AdminController::class, 'datatblesList'])->name('admin.list.datatbles');

    //Employes

    Route::get('/employes', [EmployeController::class, 'List'])->name('emp.list');

    Route::get('/employes/add', [EmployeController::class, 'add'])->name('emp.add');

    Route::post('/employes/add/submit', [EmployeController::class, 'addSubmit'])->name('emp.add.submit');

    Route::get('/employes/edit/{id}', [EmployeController::class, 'edit'])->name('emp.edit');

    Route::post('/employes/edit/submit', [EmployeController::class, 'editSubmit'])->name('emp.edit.submit');

    Route::get('/employes/delete/{id}', [EmployeController::class, 'delete'])->name('emp.delete');

    Route::get('/employes/datatables', [EmployeController::class, 'datatblesList'])->name('emp.list.datatbles');

    //Clients

    Route::get('/clients', [ClientController::class, 'List'])->name('client.list');

    Route::get('/clients/add', [ClientController::class, 'add'])->name('client.add');

    Route::post('/clients/add/submit', [ClientController::class, 'addSubmit'])->name('client.add.submit');

    Route::get('/clients/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');

    Route::post('/clients/edit/submit', [ClientController::class, 'editSubmit'])->name('client.edit.submit');

    Route::get('/clients/delete/{id}', [ClientController::class, 'delete'])->name('client.delete');

    Route::get('/clients/view/{id}', [ClientController::class, 'view'])->name('client.view');

    Route::get('/clients/datatables', [ClientController::class, 'datatblesList'])->name('client.list.datatbles');

    //Payemnt History

    Route::post('/clients/add/submit', [PaymentHistoryController::class, 'addSubmit'])->name('payment.add.submit');

});

// forgot password

Route::post('/forgot-password/submit', [PasswordResetLinkController::class, 'passwordResetSubmit'])->name('password.reset.submit');

Route::get('/reset-password', [PasswordResetLinkController::class, 'passwordResetConfirm'])->name('password.reset.comfirm');

Route::post('/reset-password/submit', [PasswordResetLinkController::class, 'passwordResetConfirmSubmit'])->name('password.reset.comfirm.submit');
require __DIR__ . '/auth.php';
