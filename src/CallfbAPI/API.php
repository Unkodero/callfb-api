<?php

namespace CallfbAPI;

use CallfbAPI\Exception\APIexception;
use CallfbAPI\Exception\RequestException;

class API {

    /**
     * API URL
     */
    const API_URL = 'https://api.callfb.com/';

    /**
     * @var integer Seller ID
     */
    private $seller_id;

    /**
     * @var string Seller Key
     */
    private $key;

    /**
     * API constructor.
     *
     * @param $seller_id integer
     * @param $key string
     */
    public function __construct($seller_id, $key)
    {
        $this->seller_id = $seller_id;
        $this->key = $key;
    }

    /**
     * Get order model
     * @return Model\OrderModel
     */
    public function makeOrder()
    {
        return new Model\OrderModel($this);
    }

    /**
     * Send order
     *
     * @param Model\OrderModel $order
     * @return mixed
     * @throws Exception\APIexception
     */
    public function sendOrder(Model\OrderModel $order)
    {
        $order = ['order' => get_object_vars($order)];
        $order['order']['products'] = [$order['order']['products']];
        
        $response = $this->request('css', $order);
        
        if ($response['success']) {
            return $response['result'];
        } else {
            throw new Exception\APIexception('Order not created.');
        }
    }

    /**
     * Getting order information
     * If order_id is array - getting get information for multiply orders
     *
     * @param $order_id mixed Order(s) id(s)
     * @return array
     */
    public function getOrderInformation($order_id)
    {
        if (is_array($order_id)) {
            $method = 'sgb';
            $order_type = 'seller_orders_ids';
        } else {
            $method = 'sgd';
            $order_type = 'order_id';
        }

        $response = $this->request($method, [
                $order_type => $order_id
            ]
        );

        if ($response['success']) {
            return $response['result'];
        } else {
            throw new Exception\APIexception();
        }
    }

    /**
     * @param $method
     * @param $post_fields
     * @return mixed
     * @throws Exception\APIexception
     * @throws Exception\RequestException
     */
    private function request($method, $post_fields)
    {
        $post_fields['seller_id'] = $this->seller_id;
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
