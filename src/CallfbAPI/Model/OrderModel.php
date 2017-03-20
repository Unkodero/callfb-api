<?php

namespace CallfbAPI\Model;

class OrderModel {
    public $seller_alias_id;
    public $status;
    public $customer_name_first;
    public $customer_name_middle;
    public $customer_name_last;
    public $customer_phone;
    public $customer_email;
    public $customer_country_code;
    public $customer_state;
    public $customer_zip;
    public $customer_city;
    public $customer_address;
    public $customer_timezone;
    public $customer_language;
    public $delivery_type;
    public $delivery_cost;
    public $discount;
    public $total_products;
    public $total;
    public $currency_ticker;
    public $products = [];
    
    private $api;
    
    public function __construct(\CallfbAPI\API $api) {
        $this->api = $api;
    }
    
    public function send()
    {
        return $this->api->sendOrder($this);
    }
    
}
