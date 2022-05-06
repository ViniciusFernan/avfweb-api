<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiResponseController;
use App\Models\ContaPagar;
use Illuminate\Http\Request;

class ContasPagarController extends ApiResponseController
{

    public function novoContasPagar()
    {
        try
        {
            $crInsert = new ContaPagar();
            //$crInsert->

            $retorno = (new ContaPagar())->novoContasPagar();

            return $this->sendResponse(['user' => 1, 'senha'=>'asdf'], 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
        }
    }

    public function updateContasPagar(Request $request, $id)
    {
        try{

        }catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
        }
    }

    public function deleteContasPagar($id)
    {
        try{

        }catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
        }
    }
}
