<?php

namespace App\KhadamatTeck\Base\checkout;

use Psr\Log\LoggerInterface;

class CheckoutLogger implements LoggerInterface
{

    private $env;

    public function __construct($env)
    {
        $this->env = $env;
    }

    public function emergency(\Stringable|string $message, array $context = []): void
    {
        $this->logData($message,$context);
    }

    public function alert(\Stringable|string $message, array $context = []): void
    {
        $this->logData($message,$context);
    }

    public function critical(\Stringable|string $message, array $context = []): void
    {
        $this->logData($message,$context);
    }

    public function error(\Stringable|string $message, array $context = []): void
    {
        $this->logData($message,$context);
    }

    public function warning(\Stringable|string $message, array $context = []): void
    {
        $this->logData($message,$context);
    }

    public function notice(\Stringable|string $message, array $context = []): void
    {
        $this->logData($message,$context);
    }

    public function info(\Stringable|string $message, array $context = []): void
    {
        $this->logData($message,$context);
    }

    public function debug(\Stringable|string $message, array $context = []): void
    {
        $this->logData($message,$context);
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        $this->logData($message,$context);
    }

    public function logData(string $message, array $context){
        if($this->env == "staging") {
            // Log::emergency($message,$context);
            error_log("CheckoutLogger: " . $message);
            // error_log(json_encode($context));
        }
    }
}
