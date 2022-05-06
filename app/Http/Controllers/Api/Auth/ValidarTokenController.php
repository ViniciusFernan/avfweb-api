<?php


namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiResponseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;

class ValidarTokenController extends ApiResponseController
{

    /**
     * validat token api
     * @return \Illuminate\Http\Response
     */
    public function validar() {
        return $this->sendResponse(true);
    }
}
