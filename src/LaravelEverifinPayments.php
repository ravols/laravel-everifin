<?php

namespace Ravols\LaravelEverifin;

use Ravols\EverifinPhp\Domain\Payments\EverifinPayments;
use Ravols\EverifinPhp\Domain\Payments\Responses\GetPaymentResponse;

class LaravelEverifinPayments
{
    public function getPayment(string $paymentId): GetPaymentResponse
    {
        $everifinPayment = new EverifinPayments;

        return $everifinPayment->getPayment(paymentId: $paymentId);
    }
}
