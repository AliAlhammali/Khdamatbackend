<?php

namespace App\KhadamatTeck\Base\checkout;

use App\KhadamatTeck\Base\checkout\entity\GenerateLinkRequest;
use App\KhadamatTeck\Base\checkout\entity\GenerateLinkResponse;
use Checkout\Payments\BillingDescriptor;
use Checkout\Payments\Links\PaymentLinkRequest;
use Illuminate\Database\Eloquent\Model;

class CheckoutService
{
    use Checkout;

    /*
     * To generate the link please use the flowing code
       $generateLinkRequest = new GenerateLinkRequest(
            amount: 10,
            reference: "999",
            type: OnlinePaymentPaidFor::Invoice,
        );
        $result = (new CheckoutService())->generatePaymentLink($generateLinkRequest);
     */
    public function generatePaymentLink(GenerateLinkRequest $request): GenerateLinkResponse
    {
        $linkRequest = new PaymentLinkRequest();
        $linkRequest->amount = ($request->getAmount() * 100);
        $linkRequest->reference = $request->getReference();
        $linkRequest->currency = $this->getConfig('currency');

        $message = new BillingDescriptor();
        $message->name = "SA";
        $message->city = "Riyadh";
        $linkRequest->billing_descriptor = $message;

        $linkRequest->billing = [
            'address' => ['country' => 'SA']
        ];

        $linkRequest->processing_channel_id = $this->getConfig('processing_channel_id');
        $linkRequest->success_url = $this->getConfig('success_url');
        $linkRequest->failure_url = $this->getConfig('failure_url');
        $linkRequest->return_url = $request->getReturnUrl($this->getConfig("return_url"));

        $linkRequest->metadata = array_merge($request->getMeta(), [
            "paid_from" => "pms",
            "paid_for" => $request->getType(),
            "company_id" => $request->getData()['company_id'] ?? null,
            "id" => $this->data['id'] ?? null,
            "class" => $request->getData() instanceof Model ? $request->getData()::class : null
        ]);

        return $this->createPaymentLink($linkRequest);
    }


}
