<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\LabelManagementController;

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
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

/** Start: Language selector */
Route::get('/language/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'nl'])) {
        App::setlocale('en');
        Session::put('locale', 'en');
        return view('welcome');
    }
    App::setlocale($locale);
    Session::put('locale', $locale);
    return back();
});
/** End: Language selector */

/** Start: User management controller */
Route::get('/userManagement', [UserManagementController::class, 'index'])->name('userManagement.index');
Route::post('/userManagement/store', [UserManagementController::class, 'store'])->name('userManagement.store');
/** End: User management controller */

/** Start: Label management controller */
Route::get('/labelManagement', [LabelManagementController::class, 'index'])->name('labelManagement.index');
Route::post('/labelManagement/storeCSVFile', [LabelManagementController::class, 'storeCSVFile'])->name('labelManagement.storeCSVFile');
/** End: Label management controller */
