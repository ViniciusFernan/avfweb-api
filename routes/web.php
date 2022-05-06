<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes - Publicas
|--------------------------------------------------------------------------
|
| Rotas publicas sem necesidade de efetuar login para acessa-las
|
*/
Route::group([], function() {
    /// views API
    Route::view('/','welcomeApi');
    Route::view('/docs','welcome');

    Route::view('/login', 'auth.login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::view('/register', 'auth.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/resetsenha', function () {
        return view('auth.resetsenha');
    })->name('resetsenha');


    Route::get('/cache_clear', function() {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        return "Cache is cleared";
    });

});



Route::middleware('auth')->group( function() {

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::get('', function () { return redirect('/admin/dashboard'); });

        //Dashboard
        Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard'], function() {
            Route::view('/','backend.dashboard.dashboard');
        });

        //Usuarios
        Route::group(['namespace' => 'Usuario', 'prefix' => 'usuario'], function() {
            Route::get('/', [UserController::class, 'index']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::post('/update/{id}', [UserController::class, 'update']);
            Route::get('/delete/{id}', [RuleController::class, 'destroy']);
            Route::get('/create', [UserController::class, 'create']);
            Route::post('/store', [UserController::class, 'store']);

        });

    });
});
