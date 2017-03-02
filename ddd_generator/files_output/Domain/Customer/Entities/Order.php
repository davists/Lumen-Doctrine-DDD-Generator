<?php

namespace Domain\Customer\Entities;

/**
 * Order
 */
class Order
{
    
    /**
    * @var integer
    */
    private $order_id;

    /**
    * @var string
    */
    private $order_name;

    /**
    * @var string
    */
    private $order_weight;

    /**
     * Order constructor.
     * @param $data
     */
    public function __construct($data)
    {
        //your business logic
     }
    
    /**
    * @param integer $order_id
    */ 
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
    }

    /**
    * @param string $order_name
    */ 
    public function setOrderName($order_name)
    {
        $this->order_name = $order_name;
    }

    /**
    * @param string $order_weight
    */ 
    public function setOrderWeight($order_weight)
    {
        $this->order_weight = $order_weight;
    }

    
    /**
    * @return integer
    */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
    * @return string
    */
    public function getOrderName()
    {
        return $this->order_name;
    }

    /**
    * @return string
    */
    public function getOrderWeight()
    {
        return $this->order_weight;
    }


}

