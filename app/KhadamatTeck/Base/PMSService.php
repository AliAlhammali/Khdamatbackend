<?php

namespace App\KhadamatTeck\Base;

use App\KhadamatTeck\Base\Http\HttpStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PMSService
{
    private ?\stdClass $errors = null;


    protected function response(): Response
    {
        return (new Response())
            ->setErrors($this->getErrors());
    }


    public function setResponse($data)
    {
        return $this->response()->setData($data)->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function setSuccessMessageResponse($message, $status = HttpStatus::HTTP_OK)
    {
        return $this->response()->setData(['message' => $message])
            ->setMessage($message)->setStatusCode($status)->json();
    }

    public function setMessageResponse($message, $status = HttpStatus::HTTP_ERROR)
    {
        return $this->response()->setData(['message' => $message])
            ->setMessage($message)->setStatusCode($status)->json();
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

    /**
     * @param \stdClass|null $errors
     */
    public function setErrors(?\stdClass $errors): void
    {
        $this->errors = $errors;
    }

    /**
     * @return \stdClass|null
     */
    public function getErrors(): ?\stdClass
    {
        return $this->errors;
    }


    /**
     * @param mixed $errors
     */
    public function setError($error): void
    {
        $this->errors[] = $error;
    }


    public function readApiResponse($data)
    {
        if ($data['status_code'] == HttpStatus::HTTP_OK) {
            return $this->setResponse($data['data'])->setMeta($data['meta'] ?? null);
        } elseif (isset($data['errors']) && $data['status_code'] == HttpStatus::HTTP_VALIDATION_ERROR) {
            return $this->response()->setErrors($data['errors'])->setStatusCode($data['status_code'])->json();
        } elseif (isset($data['errors']) && $data['status_code'] == HttpStatus::HTTP_ERROR) {
            return $this->response()->setErrors($data['errors'])->setStatusCode($data['status_code'])->json();
        } elseif (isset($data['errors']) && $data['status_code'] == HttpStatus::HTTP_NOT_FOUND) {
            return $this->response()->setErrors($data['errors'])->setStatusCode($data['status_code'])->json();
        } else {
            return $this->response()->setData($data)->setStatusCode($data['status_code'])->json();
        }
    }
}
