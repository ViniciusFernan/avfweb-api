<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\ValidarTokenController;
use App\Http\Controllers\Api\PrevisaoTempo\PrevisaoTempoController as PrevisaoTempo;
use App\Http\Controllers\Api\ContasReceberController;

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

    Route::post('/novoCliente', [ClienteController::class, 'novoCliente'])->name('novoCliente');
    Route::post('/novoContasReceber', [ContasReceberController::class, 'inserirRegistroPagamento'])->name('register');



    //Curriculo
    Route::group(['namespace' => 'Curriculo', 'prefix' => 'curriculo'], function() {
        Route::get('/', [CurriculoController::class, 'index']);
        Route::post('/update/{id}', [CurriculoController::class, 'update']);
        Route::get('/delete/{id}', [CurriculoController::class, 'destroy']);
        Route::get('/create', [CurriculoController::class, 'showForm']);
        Route::post('/store', [CurriculoController::class, 'store']);
        Route::get('/{id}', [CurriculoController::class, 'show']);
    });

});


/*
|--------------------------------------------------------------------------
| API Routes - Publicas
|--------------------------------------------------------------------------
| Rotas publicas sem necesidade de efetuar login para acessa-las
*/
Route::namespace('API')->name('api')->group(function () {
    Route::view('/', 'welcomeApi');
    Route::post('/previsaotempo/getCidades', [PrevisaoTempo::class, 'getCidades'])->name('previsaotempocidades');
    Route::post('/previsaotempo/getPrevisaoTempoPorCidade', [PrevisaoTempo::class, 'getPrevisaoTempo'])->name('previsaotempo');

});
