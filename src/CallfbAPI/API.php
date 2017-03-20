<?php

namespace CallfbAPI;

class API {
    const API_URL = 'https://api.callfb.com/';
    
    private $seller_id;
    private $key;
    
    public function __construct($seller_id, $key)
    {
        $this->seller_id = $seller_id;
        $this->key = $key;
    }
    
    public function makeOrder()
    {
        return new Model\OrderModel($this);
    }
    
    public function sendOrder(Model\OrderModel $order)
    {
        $order = ['order' => get_object_vars($order)];
        $order['seller_id'] = $this->seller_id;
        $order['order']['products'] = [$order['order']['products']];
        
        $response = $this->request('css', $order);
        
        if ($response['success']) {
            return $response['result'];
        } else {
            throw new Exception\APIexception('Order not created.');
        }
    }
    
    public function getOrderInformation($login, $password, $order_id)
    {
        //TODO: узнать ответ данного метода
        return $this->request('sgd', [
                'login' => $login, 
                'password' => $password, 
                'order_id' => $order_id
            ]
        );
    }
    
    private function request($method, $post_fields)
    {
        $post_fields = http_build_query($post_fields);
        
        $sign = md5('/' . $method . $post_fields . $this->key);
        
        $ch = curl_init();  
        
        $options = [
                CURLOPT_URL => self::API_URL . $method,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $post_fields,
                CURLOPT_HTTPHEADER => ["Sign: {$sign}"]
            ];
            
        curl_setopt_array($ch, $options);
        
        $response = curl_exec($ch);
        
        //var_dump($response);
        
        if (!$response) {
            throw new Exception\RequestException('Error while making request to Callfb API');
        } 
        
        $response = json_decode($response, true);
        
        if (isset($response['error'])) {
            throw new Exception\APIexception($response['message']);
        }
        
        return $response;
    }
}
