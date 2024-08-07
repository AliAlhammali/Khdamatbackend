<?php

namespace App\KhadamatTeck\Base\checkout\entity;


use App\KhadamatTeck\Base\checkout\enums\OnlinePaymentPaidFor;

class GenerateLinkRequest
{
    /**
     * @var string from [App\KhadamatTeck\OnlinePayments\Enums\OnlinePaymentPaidFor]
     */
    private string $type;

    /**
     * @var float
     */
    private float $amount;

    /**
     * @var string id or any reference
     */
    private string $reference;
    private array|object $data;
    private array $meta;


    /**
     * @param string $type App\KhadamatTeck\OnlinePayments\Enums\OnlinePaymentPaidFor
     * @param float $amount
     * @param string $reference id or any reference
     */
    public function __construct(float $amount, string $reference, string $type = "invoice", $data = [], $meta = [])
    {
        $this->type = $type;
        $this->amount = $amount;
        $this->reference = $reference;
        $this->data = $data;
        $this->meta = $meta;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    public function getData(): array|object
    {
        return $this->data;
    }

    public function setData(array|object $data): void
    {
        $this->data = $data;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }

    public function setMeta(array $meta): void
    {
        $this->meta = $meta;
    }

    public function getReturnUrl($returnUrl): string
    {
        switch ($this->type) {
            case OnlinePaymentPaidFor::Invoice:
                return $returnUrl . "/accounting/invoices/pay/" . $this->reference;
            case OnlinePaymentPaidFor::PackageInvoice:
                return $returnUrl . "/packages/my-packages/" . $this->reference;
            case OnlinePaymentPaidFor::PlanInvoice:
            case OnlinePaymentPaidFor::SubscriptionInvoice:
            case OnlinePaymentPaidFor::ChangeSubscriptionPlan:
            case OnlinePaymentPaidFor::RenewSubscription:
            case OnlinePaymentPaidFor::NewSubscriptionPlanAddons:
                return $returnUrl . "/settings/subscriptions";
            //return $url . "/payment-check?payment_id=" . $this->reference . '&dir=settings/subscriptions/' . '&payment_type=' . $this->type . '_subscription';
        }
        return $returnUrl;
    }
}
