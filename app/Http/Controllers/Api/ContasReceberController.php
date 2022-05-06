<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\ApiResponseController;
use app\Models\ContaReceber;

class ContasReceberController extends ApiResponseController
{
    private function inserirContasReceberAutomatic()
    {
        try
        {
            $crInsert = new ContaReceber();

            $retorno = (new ContaReceber())->novoContasReceber($crInsert);

            return $this->sendResponse(['user' => 1, 'senha'=>'asdf'], 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
        }
    }

    public function novoContasReceber()
    {
        try
        {
            $crInsert = new ContaReceber();
            $crInsert->

            $retorno = (new ContaReceber())->novoContasReceber();

            return $this->sendResponse(['user' => 1, 'senha'=>'asdf'], 200);
        } catch (\Exception $e) {

            $response = ['message' => 'Usuario não encontrado!'];
            return $this->sendError('Usuario não encontrado!',[], 404);
        }
    }

    public function updateContasReceber(Request $request, $id)
    {
        try{

        }catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
        }
    }

    public function deleteContasReceber($id)
    {
        try{

        }catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
        }
    }
}
