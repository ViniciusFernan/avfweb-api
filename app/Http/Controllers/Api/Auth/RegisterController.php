<?php


namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
    /**
     * Register api*
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'cpf' => 'required',
            'nome' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'telefone' => 'required',
            'sexo' => 'required',
            'data_nascimento' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Dado requerido não enviado', $validator->errors());
        }

        $input = $request->all();
        $input['c_password'] = (isset($input['c_password']) && !empty($input['c_password'])) ? $input['c_password'] : $input['password'];
        $user = User::novoUsuario($input);
        if($user instanceof \Exception) throw ($user);

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['nome'] =  $user->nome;

        return $this->sendResponse($success);
    }
}
