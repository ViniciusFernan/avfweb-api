<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as ApiController;
use app\Models\ContaReceber;

class ContasReceberController extends ApiController
{
    public function inserirRegistroPagamento()
    {
        try
        {
            $retorno = (new ContaReceber())->novoContasReceber();

            return $this->sendResponse(['user' => 1, 'senha'=>'asdf'], 200);
        } catch (\Exception $e) {

            $response = ['message' => 'Usuario não encontrado!'];
            return $this->sendError('Usuario não encontrado!',[], 404);
        }
    }
}
