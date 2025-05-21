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

    public function getClientBanks(
        ?string $countryCode = null,
    ): array {
        $everifinPayment = new EverifinPayments;

        $responseData = $everifinPayment->getClientBanks(countryCode: $countryCode);

        return $responseData;
    }
}
