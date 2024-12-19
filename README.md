# Laravel Everifin Payment Gateway
![image](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)  ![image](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

![image](https://github.com/user-attachments/assets/cbcfec66-b1d6-48c6-81d0-a0eb1ff39406)

This package serves as a Laravel bridge, enabling the seamless creation and management of payments through the Everifin payment gateway. It is built upon the original PHP SDK from Everifin, ensuring robust functionality and compatibility. Check the PHP SDK [here](https://github.com/ravols/everifin-sdk-php).

## Installation

You can install the package via composer:

```bash
composer require ravols/laravel-everifin
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-everifin-config"
```

This is the contents of the published config file:

```php
return [
    'client_id' => env('EVERIFIN_CLIENT_ID'),
    'client_secret' => env('EVERIFIN_CLIENT_SECRET'),
    'client_iban' => env('EVERIFIN_CLIENT_IBAN'),
];
```

You can use this config values when setting up your Config instance.

## Usage

To begin, you need to create an instance of your Config class. This instance is designed as a singleton, meaning it's only instantiated once during the lifecycle of your application. The reason it's not globally defined in a provided service is to cater for situations where your project supports multiple e-commerce sites and requires dynamic configuration value changes.

In most cases, adhere to the following approach:

```php
<?php
use Ravols\EverifinPhp\Config;
use Ravols\LaravelEverifin\Facades\LaravelEverifinOrders;

class EverifinPaymentProcessor {

    public function __construct()
    {
        Config::getInstance()->setClientSecret(config('everifin.client_secret'))->setClientIban(config('everifin.client_iban'))->setClientId(config('everifin.client_id'));
    }

    public function createPaymentLink(Order $order): string
    {
      //Your logic for ecommerce orders
      $responseData = LaravelEverifinOrders::createPayment(
            amount: 120.99,
            currency: 'EUR',
            redirectUrl: 'https://my-domain/payment/' . $order->number,
            recipientIban: Config::getInstance()->getClientIban(),
            message: 'My message',
            email: $order->user->email,
            recipientName: 'My company name',
            variableSymbol: 'Variable symbol', //For non CZ and SK sites use reference field
        );

        //$responseData contains much more than a link, feel free to check it out
        return $responseData->link;
    }
}
```

Once the payment is paid for or cancelled on the payment gateway, customer is redirect back to the redirectUrl that you provided in the createPayment method. Now, you need to retrieve the payment status and handle your order as you wish.

You can retireve the payment ID as it's always send back to the redirect url as a get parameter ID or store it in a database during payment creation from the $responseData above.

```php
    use Ravols\LaravelEverifin\Facades\LaravelEverifinPayments;
    use Ravols\EverifinPhp\Exceptions\ResponseException;
    //Your logic in class

    //Get payment status
    try {
        $paymentStatus = LaravelEverifinPayments::getPayment(paymentId: request()->id);
    } catch (ResponseException $e) {
        $errors = collect($e->errors); //Here you can find errors from Everifin gateway in case request fails
        //Your logic for handling error cases
    }
    //Your logic with ifs, switch cases or any other way
    if($paymentStatus === 'BOOKED')
    {
        //Complete order logic
    }

    if($paymentStatus === 'FAILED')
    {
        //Handle error statuses.
    }

```

List of all statuses can be found on the [documentation page](https://everifin.atlassian.net/wiki/spaces/EPAD/pages/2467561491/Paygate+Payment+Flow).

List of error codes and their descriptions can be found on the [documentation page](https://everifin.atlassian.net/wiki/spaces/EFMBAPI/pages/2515730751/Errors).



## Credits

- [Rudolf Bruder](https://github.com/rudolfbruder)
- [Jaroslav Štefanec](https://github.com/jaroslavstefanec)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
