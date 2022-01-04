<?php


namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends BaseController
{

    /**
     * Logout api
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'Usuario deslogado com sucesso!'];
        return response($response, 200);
    }
}
