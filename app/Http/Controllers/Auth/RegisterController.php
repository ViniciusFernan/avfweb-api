<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Rule;
use App\Models\Usuario;
use App\Models\UserRule;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;



/*
|--------------------------------------------------------------------------
| Login Controller
|--------------------------------------------------------------------------
*/
class RegisterController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function getViewRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        try{
            $request['password'] = $request->password;

            $validator = Validator::make($request->all(), [
                'cpf' => 'required',
                'nome' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'telefone' => 'required',
                'sexo' => 'required',
                'data_nascimento' => 'required',
            ]);

            if($validator->fails())
                throw new \Exception('Dado requerido não enviado - '. $validator->errors());
            $input = $request->all();

            //// novo cliente
            Cliente::novoCliente($input);

            $userData['email'] = $input['email'];
            $userData['password'] = $input['password'];
            $user = Usuario::novoUsuario($input);

            var_dump($user);
            exit;

            Auth()->login($user);

            return redirect('/admin/dashboard');

        } catch (\Exception $e) {
            return Redirect::back()->with('alertView', Helper::alertView($e->getMessage(), 2));
        }
    }

}
