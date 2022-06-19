<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\LabelManagementController;
use App\Http\Controllers\ReviewController;

// Models
use App\Models\User;
use App\Models\Label;

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
    return redirect(route('labelManagement.showByBar'));
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

/** Start: Language selector */
Route::get('/language/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'nl'])) {
        App::setlocale('en');
        return view('welcome');
    }
    App::setlocale($locale);
    return redirect()->back();

});
/** End: Language selector */

/** Start: User management controller */
Route::get('/userManagement', [UserManagementController::class, 'index'])->can('viewAny', User::class)->name('userManagement.index');
Route::post('/userManagement/store', [UserManagementController::class, 'store'])->can('create', User::class)->name('userManagement.store');
/** End: User management controller */

/** Start: Label management controller */
Route::get('/labelManagement', [LabelManagementController::class, 'index'])->can('viewAny', Label::class)->name('labelManagement.index');
Route::get('/labelManagement/myLabels', [LabelManagementController::class, 'index'])->can('viewAnyOwn', Label::class)->name('labelManagement.MyLabels');
Route::post('/labelManagement/storeCSVFile', [LabelManagementController::class, 'storeCSVFile'])->can('create', Label::class)->name('labelManagement.storeCSVFile');
Route::post('/labelManagement/label/{id}/setStatus', [LabelManagementController::class, 'setStatus'])->can('updateStatus', Label::class)->name('labelManagement.label.updateStatus');
Route::get('/labelManagement/barCodeSearch/{id?}', [LabelManagementController::class, 'showByBar'])->name('labelManagement.showByBar');
/** End: Label management controller */

/** Start: Review management controller */
Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
/** End: Review management controller */
