<?php

namespace App\KhadamatTeck\Base;

use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

abstract class BasicService implements ServiceInterface
{
    private array $errors = [];



    protected function response($statusCode = HttpStatus::HTTP_OK): Response|JsonResponse
    {
        return (new Response($statusCode))
            ->setErrors($this->getErrors());
    }

    public function setResponse($data){
        return $this->response()->setData($data)->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function setErrorResponse($message, $status = HttpStatus::HTTP_ERROR)
    {
        return $this->response()->setErrors(['message' => $message])->setStatusCode($status)->json();
    }

    public function tryAndResponse(callable $func): Response|JsonResponse
    {
        try {
            DB::beginTransaction();
            $result = $func();
            DB::commit();
            return $result;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function setMessageResponse($message, $status = HttpStatus::HTTP_ERROR)
    {
        return $this->response()
            ->setData(['message' => $message])
            ->setMessage($message)
            ->setStatusCode($status)->json();
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param  array  $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    /**
     * @param  string  $error
     */
    public function setError(string $error): void
    {
        $this->errors[] = $error;
    }
}
