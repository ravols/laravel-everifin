<?php

namespace Ravols\LaravelEverifin;

use Ravols\EverifinPhp\Domain\Orders\EverifinOrders;
use Ravols\EverifinPhp\Domain\Orders\Requests\CreatePaymentRequest;

class LaravelEverifinOrders
{
    public function createPaymentRedirectUrl(
        float $amount, string $currency, string $redirectUrl, string $recipientIban, string $variableSymbol, string $message, string $email
    ): string {
        $everifinOrders = new EverifinOrders;
        $createPaymentRequest = new CreatePaymentRequest(
            instructionId: '',
            amount: $amount,
            currency: $currency,
            redirectUrl: $redirectUrl,
            recipientIban: $recipientIban,
            senderBankId: 'fkbaredn',
            recipientBankBic: 'uncrskbx',
            variableSymbol: $variableSymbol,
            constantSymbol: '0308',
            specificSymbol: '0000000003',
            paymentMessage: $message,
            externalId: 'ext4123',
            senderEmail: $email,
        );

        $responseData = $everifinOrders->createOrderPaymentResponse(createPaymentRequest: $createPaymentRequest);

        return $responseData->link;
    }
}
