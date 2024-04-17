<?php

namespace App\KhadamatTeck\Base;

use Illuminate\Http\JsonResponse;

class Response implements \JsonSerializable
{
    /**
     * @var int $statusCode
     */
    private $statusCode = 200;
    /**
     * @var mixed $errors
     */
    private mixed $errors = null;
    /**
     * @var mixed $data
     */
    private $data = null;
    private $extraData = null;
    /**
     * @var mixed $data
     */
    private $meta = null;
    /**
     * @var mixed $data
     */
    private $debug = null;
    /**
     * @var array $headers
     */
    private $headers = [];
    /**
     * @var string $message
     */
    private $message = "";
    /**
     * @var string $source
     */
    private string $source = 'api';

    public function __construct($statusCode = 200, $data = null)
    {
        $this->statusCode = $statusCode;
        $this->data = $data ?? new \stdClass();
        $this->errors = new \stdClass();
    }

    /**
     * @return null
     */
    public function getExtraData()
    {
        return $this->extraData;
    }

    /**
     * @param null $extraData
     */
    public function setExtraData($extraData): void
    {
        $this->extraData = $extraData;
    }


    /**
     * build and return the json response
     *
     * @return JsonResponse
     */
    public function json()
    {
        return response()->json([
            'status_code' => $this->getStatusCode(),
            'errors' => $this->getErrors() ?? (new \stdClass()),
            'data' => $this->getData() ?? (new \stdClass()),
            'extra_data' => $this->getExtraData() ?? (new \stdClass()),
            'message' => $this->getMessage(),
            'source' => $this->getSource(),
        ],
            $this->getStatusCode(),
            $this->getHeaders()
        );
    }

    /**
     * return the data that can be serialized as json
     */
    public function jsonSerialize()
    {
        $return_data = [
            'status_code' => $this->getStatusCode(),
            'errors' => $this->getErrors() ?? (new \stdClass()),
            'data' => $this->getData() ?? (new \stdClass()),
            'extra_data' => $this->getExtraData() ?? (new \stdClass()),
            'meta' => $this->getMeta() ?? (new \stdClass()),
            'message' => $this->getMessage(),
            'source' => $this->getSource(),
        ];
        if (env('APP_DEBUG', false)) {
            $return_data += ['debug' => $this->getDebug()];
        }
        return $return_data;
    }

    /**
     * @param string $message
     *
     * @return Response
     */
    public function setMessage(string $message): Response
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $source
     *
     * @return Response
     */
    public function setSource(string $source): Response
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     *
     * @return Response
     */
    public function setStatusCode(int $statusCode): Response
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function getErrors(): mixed
    {
        if (is_array($this->errors) && empty($this->errors)) {
            $this->errors = new \stdClass();
        }
        return is_string($this->errors) ? (object)['error' => $this->errors] : $this->errors;
    }

    public function setErrors(mixed $errors): Response
    {
        $this->errors = $errors;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     *
     * @return Response
     */
    public function setData(mixed $data): Response
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMeta(): mixed
    {
        return $this->meta;
    }

    /**
     * @param mixed $data
     *
     * @return Response
     */
    public function setMeta(mixed $meta): Response
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     *
     * @return Response
     */
    public function setHeaders(array $headers): Response
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return array
     */
    public function getDebug(): array
    {
        $collect = collect(\Illuminate\Support\Facades\DB::getQueryLog());
        return [
            'count' => $collect->count(),
            'total_time' => $collect->sum('time'),
            'bigest_time' => $collect->max('time'),
            'queries' => $collect->toArray()
        ];
    }

}
