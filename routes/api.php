<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\ValidarTokenController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\PrevisaoTempo\PrevisaoTempoController as PrevisaoTempo;

/*
|--------------------------------------------------------------------------
| API Routes - Privadas
|--------------------------------------------------------------------------
| Rotas privadas necessário efetuar login para acessa-las
*/
Route::middleware('auth:api')->group(function (){
    //Utilizado apenas para validar o token
    Route::get('/validatoken',  [ValidarTokenController::class,'validar']);
    Route::get('/user', function (Request $request) { return $request->user();});
});


/*
|--------------------------------------------------------------------------
| API Routes - Publicas
|--------------------------------------------------------------------------
| Rotas publicas sem necesidade de efetuar login para acessa-las
*/
Route::namespace('API')->name('api')->group(function () {
    Route::view('/', 'welcomeApi');
    Route::post('/previsaotempocidades', [PrevisaoTempo::class, 'getCidades'])->name('previsaotempocidades');
    Route::post('/previsaotempo', [PrevisaoTempo::class, 'getPrevisaoTempo'])->name('previsaotempo');

    Route::post('/registerAPI', [RegisterController::class, 'Register'])->name('register');
});
