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
    print_r($api->getOrderInformation(order_id));
    print_r($api->getOrderInformation([
        123, 67845, 11233542, 1234, 668755
    ]));
} catch (CallfbAPI\Exception\APIexception $e) {
    //
} catch (CallfbAPI\Exception\RequestException $e) {
    //
}


/*
(numered array if multiply)
array(31) {
  ["id"]=>
  int(2)
  ["seller_alias_id"]=>
  string(5) "24525"
  ["seller_id"]=>
  int(2)
  ["status"]=>
  int(0)
  ["creation_date"]=>
  string(19) "2017-03-20 18:25:30"
  ["edit_date"]=>
  string(19) "2017-03-20 18:25:30"
  ["call_date"]=>
  NULL
  ["assigned"]=>
  int(0)
  ["customer_name_first"]=>
  string(6) "╨Ш╨╝╤П"
  ["customer_name_middle"]=>
  string(16) "╨Ю╤В╤З╨╡╤Б╤В╨▓╨╛"
  ["customer_name_last"]=>
  string(14) "╨д╨░╨╝╨╕╨╗╨╕╤П"
  ["customer_phone"]=>
  string(12) "+79991234567"
  ["customer_email"]=>
  string(13) "test@test.net"
  ["customer_country_code"]=>
  string(2) "RU"
  ["customer_state"]=>
  string(18) "Stavropolskiy kray"
  ["customer_zip"]=>
  string(6) "355023"
  ["customer_city"]=>
  string(9) "Stavropol"
  ["customer_address"]=>
  string(15) "Pushkina street"
  ["customer_timezone"]=>
  int(4)
  ["customer_language"]=>
  string(2) "RU"
  ["order_comment"]=>
  NULL
  ["delivery_type"]=>
  string(2) "hz"
  ["delivery_cost"]=>
  string(7) "1000.00"
  ["discount"]=>
  int(0)
  ["total_products"]=>
  string(4) "1.00"
  ["total"]=>
  string(6) "100.00"
  ["total_usd"]=>
  string(6) "100.00"
  ["currency_ticker"]=>
  string(3) "USD"
  ["order_id"]=>
  int(2)
  ["products"]=>
  array(1) {
    [0]=>
    array(13) {
      ["link_id"]=>
      int(1)
      ["seller_product_id"]=>
      int(5)
      ["product_id"]=>
      int(2)
      ["main"]=>
      int(0)
      ["title"]=>
      string(18) "Revitalizing cream"
      ["image_filename"]=>
      string(48) "https://cdn.callfb.com/uploads/images/633517.png"
      ["description"]=>
      NULL
      ["specification"]=>
      NULL
      ["script"]=>
      NULL
      ["order_id"]=>
      int(2)
      ["price"]=>
      string(6) "100.00"
      ["currency_ticker"]=>
      string(3) "USD"
      ["quantity"]=>
      int(1)
    }
  }
  ["seller_name"]=>
  string(16) "Goji Seller Test"
}
*/
```
