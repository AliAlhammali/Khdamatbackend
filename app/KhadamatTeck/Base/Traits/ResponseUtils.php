<?php

namespace App\KhadamatTeck\Base\Traits;

use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use Illuminate\Http\JsonResponse;

trait ResponseUtils
{
    protected function response($statusCode = HttpStatus::HTTP_OK): Response|JsonResponse
    {
        return (new Response($statusCode));
    }

    public function setErrorsResponse($errors){
        return $this->response()->setErrors($errors)->setStatusCode(HttpStatus::HTTP_ERROR);
    }
    public function setResponse($data){
        return $this->response()->setData($data)->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function setSuccessResponse($message, $status = HttpStatus::HTTP_OK)
    {
        return $this->response()->setData(['message' => $message])->setMessage($message)->setStatusCode($status)->json();
    }

    public function setErrorResponse($message, $status = HttpStatus::HTTP_ERROR)
    {
        return $this->response()->setErrors(['message' => $message])->setMessage($message)->setStatusCode($status)->json();
    }

}
