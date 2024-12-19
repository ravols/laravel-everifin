<?php

namespace Ravols\LaravelEverifin;

use Ravols\EverifinPhp\Domain\Orders\EverifinOrders;
use Ravols\EverifinPhp\Domain\Orders\Requests\CreatePaymentRequest;
use Ravols\EverifinPhp\Domain\Orders\Responses\CreatePaymentResponse;

class LaravelEverifinOrders
{
    public function createPayment(
        float $amount,
        string $currency,
        string $redirectUrl,
        string $recipientIban,
        string $variableSymbol,
        string $message,
        string $email,
        ?string $constantSymbol = null,
        ?string $specificSymbol = null,
        ?string $externalId = null,
        ?string $senderBankId = null,
        ?string $recipientBankBic = null,
        ?string $instructionId = null,
        ?string $reference = null,
        ?string $recipientName = null,
        int $refundLimitPercentage = 100,
        bool $disableHooks = false,
    ): CreatePaymentResponse {
        $everifinOrders = new EverifinOrders;

        $createPaymentRequest = new CreatePaymentRequest(
            instructionId: $instructionId,
            amount: $amount,
            currency: $currency,
            redirectUrl: $redirectUrl,
            recipientIban: $recipientIban,
            recipientBankBic: $recipientBankBic,
            senderBankId: $senderBankId,
            variableSymbol: $variableSymbol,
            constantSymbol: $constantSymbol,
            specificSymbol: $specificSymbol,
            reference: $reference,
            paymentMessage: $message,
            recipientName: $recipientName,
            refundLimitPercentage: $refundLimitPercentage,
            externalId: $externalId,
            disableHooks: $disableHooks,
            senderEmail: $email,
        );

        $responseData = $everifinOrders->createOrderPaymentResponse(createPaymentRequest: $createPaymentRequest);

        return $responseData;
    }
}
