<?php


namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiResponseController;
use App\Models\Cliente;
use Validator;

class ClienteController extends ApiResponseController
{
    /**
     * Register api*
     * @return \Illuminate\Http\Response
     */
    public function novoCliente(Request $request) {
        try{
            $validator = Validator::make($request->all(), [
                'cpf' => 'required',
                'nome' => 'required',
                'sobre_nome' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'c_password' => 'required|same:password',
                'telefone' => 'required',
                'sexo' => 'required',
                'data_nascimento' => 'required',
            ]);

            if($validator->fails())
                throw new \Exception('Dado requerido não enviado', $validator->errors());


            $input = $request->all();
            $cliente = Cliente::novoCliente($input);
            if($cliente instanceof \Exception) throw ($cliente);
            return $this->sendResponse('Cliente cadastrado com sucesso');
        }catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
        }
    }

    public function updateCliente(Request $request, $id)
    {
        try{

        }catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
        }
    }

    public function deleteCliente($id)
    {
        try{

        }catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
        }
    }
}
