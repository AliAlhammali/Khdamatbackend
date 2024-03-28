<?php

namespace App\KhadamatTeck\Base\checkout\enums;


class OnlinePaymentPaidFor
{
    const Invoice = 'invoice';
    const PackageInvoice = 'package_invoice';
    const PlanInvoice = 'plan_invoice';
    const SubscriptionInvoice = 'subscription_invoice';
    const RenewSubscription = 'renew_subscription';
    const ChangeSubscriptionPlan = 'change_subscription_plan';
    const NewSubscriptionPlanAddons = 'new_subscription_plan_addons';
}
