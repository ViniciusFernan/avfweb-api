<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;


class ApiResponseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result) {
        $response = ['success' => true,  'data' => $result];
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($errorMSG, $errorData = [], $code = 404) {
        $response = ['success' => false, 'message' => $errorMSG ];

        if (!empty($errorData)) {
            $response['data'] = $errorData;
        }

        return response()->json($response, $code);
    }
}
