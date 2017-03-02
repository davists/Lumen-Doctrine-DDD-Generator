<?php

namespace Domain\Customer\Entities;

/**
 * Customer
 */
class Customer
{
    
    /**
    * @var integer
    */
    private $customer_id;

    /**
    * @var string
    */
    private $customer_name;

    /**
    * @var string
    */
    private $customer_weight;

    /**
     * Customer constructor.
     * @param $data
     */
    public function __construct($data)
    {
        //your business logic
     }
    
    /**
    * @param integer $customer_id
    */ 
    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    /**
    * @param string $customer_name
    */ 
    public function setCustomerName($customer_name)
    {
        $this->customer_name = $customer_name;
    }

    /**
    * @param string $customer_weight
    */ 
    public function setCustomerWeight($customer_weight)
    {
        $this->customer_weight = $customer_weight;
    }

    
    /**
    * @return integer
    */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
    * @return string
    */
    public function getCustomerName()
    {
        return $this->customer_name;
    }

    /**
    * @return string
    */
    public function getCustomerWeight()
    {
        return $this->customer_weight;
    }


}

