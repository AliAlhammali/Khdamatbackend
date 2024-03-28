<?php

namespace App\KhadamatTeck\Base\checkout;

use App\KhadamatTeck\Base\checkout\entity\CheckoutResponse;
use App\KhadamatTeck\Base\checkout\entity\GenerateLinkResponse;
use Checkout\CheckoutApi;
use Checkout\CheckoutApiException;
use Checkout\CheckoutAuthorizationException;
use Checkout\CheckoutSdk;
use Checkout\Environment;
use Checkout\Payments\CaptureRequest;
use Checkout\Payments\Links\PaymentLinkRequest;
use Illuminate\Support\Facades\Log;

trait Checkout
{
    private string $environment = "production";// sandbox, production
    private array $config;

    public function __construct()
    {
        $this->environment = config('payment_gateways.environment');
        if ($this->environment == "production")
            $this->config = config('payment_gateways.checkout_production');
        else
            $this->config = config('payment_gateways.checkout_sandbox');
    }

    private function getConfig($key): ?string
    {
        return $this->config[$key];
    }


    private function checkoutApi(): CheckoutApi
    {
        return CheckoutSdk::builder()->staticKeys()
            ->publicKey($this->config['public_key']) // optional, only required for operations related with tokens
            ->secretKey($this->config['secret_key'])
            ->environment($this->environment == "production" ? Environment::production() : Environment::sandbox())
            ->logger(new CheckoutLogger(env("APP_ENV"))) //optional, for a custom Logger
            //->httpClientBuilder($client) // optional, for a custom HTTP client
            ->build();
    }

    private function log(CheckoutResponse $response)
    {
        if (!$response->isSuccessful()) {
            Log::emergency($response->getMessage(), (array)$response);
            error_log("CheckoutLog: " . $response->getMessage());
            error_log("CheckoutLog: " . json_encode($response));
        }
    }


    public function createPaymentLink(PaymentLinkRequest $paymentLinkRequest): GenerateLinkResponse
    {
        $response = new GenerateLinkResponse();
        try {
            $result = $this->checkoutApi()->getPaymentLinksClient()->createPaymentLink($paymentLinkRequest);
            $response->setIsSuccessful(true);
            $response->setPaymentId($result["id"]);
            $response->setPaymentLink($result["_links"]["redirect"]["href"]);
        } catch (CheckoutApiException $e) {
            $response->setIsSuccessful(false);
            $response->setMessage($e->getMessage());
            $response->setError([
                "type" => "API error",
                "error_details" => $e->error_details,
                "http_status_code" => isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null,
            ]);
        } catch (CheckoutAuthorizationException|\Exception $e) {
            $response->setIsSuccessful(false);
            $response->setMessage($e->getMessage());
            $response->setError([
                "type" => "Bad Invalid authorization"
            ]);
        }
        $this->log($response);
        return $response;
    }

    public function capturePayment($paymentId): CheckoutResponse
    {
        $response = new CheckoutResponse();
        try {
            $request = new CaptureRequest();
            $result = $this->checkoutApi()->getPaymentsClient()->capturePayment($paymentId, $request);
            $response->setIsSuccessful(true);
            $response->setResult($result);
        } catch (CheckoutApiException $e) {
            $response->setIsSuccessful(false);
            $response->setMessage($e->getMessage());
            $response->setError([
                "type" => "API error",
                "error_details" => $e->error_details,
                "http_status_code" => isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null,
            ]);
        } catch (CheckoutAuthorizationException|\Exception $e) {
            $response->setIsSuccessful(false);
            $response->setMessage($e->getMessage());
            $response->setError([
                "type" => "Bad Invalid authorization"
            ]);
        }
        $this->log($response);
        return $response;
    }

    public function getPaymentDetails($paymentId): CheckoutResponse
    {
        $response = new CheckoutResponse();
        try {
            $result = $this->checkoutApi()->getPaymentsClient()->getPaymentDetails($paymentId);
            $response->setIsSuccessful(true);
            $response->setResult($result);
        } catch (CheckoutApiException $e) {
            $response->setIsSuccessful(false);
            $response->setMessage($e->getMessage());
            $response->setError([
                "type" => "API error",
                "error_details" => $e->error_details,
                "http_status_code" => isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null,
            ]);
        } catch (CheckoutAuthorizationException|\Exception $e) {
            $response->setIsSuccessful(false);
            $response->setMessage($e->getMessage());
            $response->setError([
                "type" => "Bad Invalid authorization"
            ]);
        }
        $this->log($response);
        return $response;
    }

    public function refundPayment($paymentId): CheckoutResponse
    {
        $response = new CheckoutResponse();
        try {
            $result = $this->checkoutApi()->getPaymentsClient()->refundPayment($paymentId);
            $response->setIsSuccessful(true);
            $response->setResult($result);
        } catch (CheckoutApiException $e) {
            $response->setIsSuccessful(false);
            $response->setMessage($e->getMessage());
            $response->setError([
                "type" => "API error",
                "error_details" => $e->error_details,
                "http_status_code" => isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null,
            ]);
        } catch (CheckoutAuthorizationException|\Exception $e) {
            $response->setIsSuccessful(false);
            $response->setMessage($e->getMessage());
            $response->setError([
                "type" => "Bad Invalid authorization"
            ]);
        }
        $this->log($response);
        return $response;
    }
}
