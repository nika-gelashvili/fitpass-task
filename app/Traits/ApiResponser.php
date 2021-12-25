<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    public $responseStatusMessage = '';

    /**
     * Build Success Response
     * @param $data
     * @param $code
     * @param $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK, $headers = []){
        $response = [];
        if(!is_null($this->responseStatusCode)){
            $response["statusCode"] = $this->responseStatusCode;
            $response["statusMessage"] = $this->responseStatusMessage;
        }

        $response['data'] =  $data;

        return \response()->json($response, $code, $headers);
    }


    /**
     * Build Error Response
     * @param $message
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code = Response::HTTP_EXPECTATION_FAILED)
    {
        return \response()->json($message, $code);
    }

    /**
     * Handles preflight request
     * headers should be defined explicitly here because if route is not defined for options request
     * then it bypasses all midlleware hence custom headers setting.
     * @return \Illuminate\Http\JsonResponse
     */
    public function preflightResponse(){
        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE, authtoken',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With, authtoken'
        ];

        return $this->successResponse(['status' => 'preflight request passed successfuly'], Response::HTTP_OK, $headers);
    }

    /**
     * @param int $statusCode
     * @param string $statusMessage
     * @return void
     */
    public function setResponseStatus(int $statusCode, string $statusMessage)
    {
        $this->responseStatusCode = $statusCode;
        $this->responseStatusMessage = $statusMessage;
    }

    /**
     * Build 404 Response
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFoundResponse($message = 'Invalid Request')
    {
        return $this->errorResponse($message, Response::HTTP_NOT_FOUND);
    }
}
