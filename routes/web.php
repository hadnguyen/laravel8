<?php

// use App\Http\Controllers\NhomsanphamController;
// use App\Http\Controllers\SanphamController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Middleware\CheckAdminLogin;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin/login', [AdminLoginController::class,'getlogin'])->name('admin.getlogin');
Route::post('/admin/login', [AdminLoginController::class,'postlogin'])->name('admin.postlogin');
Route::get('/admin/logout', [AdminLoginController::class,'getlogout'])->name('admin.getlogout');


Route::prefix('admin')->name('admin.')->middleware([CheckAdminLogin::class])->group(function(){
    Route::get('/', [AdminLoginController::class, 'dashboard'])->name('dashboard');

    Route::resources([
        'nhomsanpham' => NhomsanphamController::class,
        'sanpham' => SanphamController::class,
        'user' => UserManagementController::class,
    ]);

    Route::get('/file', function () {
        return view('admin.file');
    })->name('file');

});

Route::get('/', function () {
    return view('site.home');
})->name('home');

Route::get('/shop', function () {
    return view('site.shop');
})->name('shop');

Route::get('/cart', function () {
    return view('site.cart');
})->name('cart');






// Route::get('/admin', function () {
//     return view('admin.dashboard');
// })->name('admin.dashboard');

// Route::prefix('admin')->name('admin.')->group(function(){
//     Route::resources([
//         'nhomsanpham' => NhomsanphamController::class,
//         'sanpham' => SanphamController::class,
//     ]);
// });

// Route::get('nhomsanpham-edit/{id}', 'NhomsanphamController@edit')->name('nhomsp_edit');
// Route::get('nhomsanpham-del/{id}', 'NhomsanphamController@delete')->name('nhomsp_del');
// Route::post('nhomsanpham-create', 'NhomsanphamController@post_create')->name('nhomsp_create');
