# Callfb API Wrapper

## Usage

Creating order
```php
<?php

$api = new CallfbAPI\API(seller_id, key);

$order = $api->makeOrder();

$order->seller_alias_id = 1; //order id
$order->status = 0;
$order->customer_name_first = 'Имя';
$order->customer_name_middle = 'Отчество';
$order->customer_name_last = 'Фамилия';
$order->customer_phone = '+79991234567';
$order->customer_email = 'test@test.net';
$order->customer_country_code = 'RU';
$order->customer_state = 'Moscow';
$order->customer_zip = '127000';
$order->customer_city = 'Moscow';
$order->customer_address = 'Pushkina street';
$order->customer_timezone = 4;
$order->customer_language = 'RU';
$order->delivery_type = 'hz';
$order->delivery_cost = 1000;
$order->discount = 0;
$order->total_products = 1;
$order->total = 100.00;
$order->currency_ticker = 'USD';
$order->products = [
        'product_id' => 5,
        'price' => 100.00,
        'currency_ticker' => 'USD',
        'quantity' => 1,
        'main' => 0
    ];
    
try {    
    echo $order->send();
} catch (CallfbAPI\Exception\APIexception $e) {
    //
} catch (CallfbAPI\Exception\RequestException $e) {
    //
}
```

Getting information
```php
...

try {    
    print_r($api->getOrderInformation(login, password, order));
} catch (CallfbAPI\Exception\APIexception $e) {
    //
} catch (CallfbAPI\Exception\RequestException $e) {
    //
}

```
