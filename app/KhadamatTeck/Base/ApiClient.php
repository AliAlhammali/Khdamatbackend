<?php

namespace App\KhadamatTeck\Base;

use App\KhadamatTeck\Base\Http\HttpStatus;
use Illuminate\Http\Client\Response as HttpResponse;
use Illuminate\Support\Facades\Http as HttpClient;
use Illuminate\Support\Facades\Log;

class ApiClient
{
    protected array $configs;
    protected string $base_url;
    protected array $headers = [];

    public function instance($target): static
    {
        $this->configs = config('external_communications');
        $this->base_url = $this->configs[$target]['url'];
        $this->setHeaders();

        return $this;
    }

    public function setHeaders(): void
    {
        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    public function parseUrl($endpoint): string
    {
        return $this->base_url . $endpoint;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function get(string $endpoint, array $query = [])
    {
        $response = HttpClient::withHeaders($this->getHeaders())->get(
            $this->parseUrl($endpoint),
            $query
        );
        return $this->parseBody($response);
    }

    public function post($endpoint, array $body = [])
    {
        $response = HttpClient::withHeaders($this->getHeaders())->post(
            $this->parseUrl($endpoint),
            $body
        );
        return $this->parseBody($response);
    }

    public function patch($endpoint, array $body = [])
    {
        $response = HttpClient::withHeaders($this->getHeaders())->patch(
            $this->parseUrl($endpoint),
            $body
        );
        return $this->parseBody($response);
    }

    public function delete($endpoint)
    {
        $response = HttpClient::withHeaders($this->getHeaders())->delete(
            $this->parseUrl($endpoint)
        );

        return $this->parseBody($response);
    }

    public function parseBody(HttpResponse $response)
    {
        if ($response->successful()) {
            return $response->json();
        } else {
            $res = $response->json();
            if (isset($res['errors']) && !empty($res['errors'])) {
                $res['status_code'] = $response->status();
                return $res;
            }
            if ($response->status() == HttpStatus::HTTP_NOT_FOUND) {
                $res['status_code'] = $response->status();
                $res['errors'] = ['Page not found'];
                return $res;
            } elseif ($response->status() == HttpStatus::HTTP_INTERNAL_SERVER_ERROR) {
                $res['status_code'] = $response->status();
                $res['errors'] = (isset($res['message'])) ? [$res['message']]
                    : ['Internal server error'];
                return $res;
            } elseif ($response->status() == HttpStatus::HTTP_ERROR) {
                $res['status_code'] = $response->status();
                $res['errors'] = (isset($res['message'])) ? [$res['message']]
                    : ['Bad request'];
            } elseif ($response->status() == HttpStatus::HTTP_VALIDATION_ERROR) {
                $res['status_code'] = $response->status();
                $res['errors'] = (isset($res['errors'])) ? [$res['errors']]
                    : ['Bad request - check validation or request body'];
                return $res;
            }

            Log::emergency('API Error', ['code' => $response->status(), 'errors' => $response->throw()]);
            return $response->throw();

        }
    }

    public function parseApiResponse(
        $data,
        Response $response,
        BaseDTOMapper $baseDTOMapper,
        bool $singleRecord = false
    ): Response
    {
        $response->setSource('Marafiq');
        if (isset($data['message'])) {
            $response->setMessage($data['message']);
        }
        if ($data['status_code'] == 200 && empty($data['errors'])) {
            if ($singleRecord) {
                $data['data'] = $baseDTOMapper::mapFromApi($data['data'], true);
            } else {
                $data['data'] = $baseDTOMapper::mapFromApi($data['data']);
            }
            return $response->setData($data['data'])->setMeta($data['meta'])
                ->setStatusCode(
                    HttpStatus::HTTP_OK
                );
        } else {
            if (is_array($data['errors'])) {
                return $response->setErrors($data['errors'])->setStatusCode(
                    (isset($data['status_code'])) ? $data['status_code']
                        : HttpStatus::HTTP_ERROR
                );
            }
            return $response->setErrors([$data['errors']])->setStatusCode(
                HttpStatus::HTTP_ERROR
            );
        }
    }
}
