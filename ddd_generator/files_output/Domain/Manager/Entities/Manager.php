<?php

namespace Domain\Manager\Entities;

/**
 * Manager
 */
class Manager
{
    
    /**
    * @var integer
    */
    private $manager_id;

    /**
    * @var string
    */
    private $name;

    /**
    * @var string
    */
    private $weight;

    /**
     * Manager constructor.
     * @param $data
     */
    public function __construct($data)
    {
        //your business logic
     }
    
    /**
    * @param integer $manager_id
    */ 
    public function setManagerId($manager_id)
    {
        $this->manager_id = $manager_id;
    }

    /**
    * @param string $name
    */ 
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
    * @param string $weight
    */ 
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    
    /**
    * @return integer
    */
    public function getManagerId()
    {
        return $this->manager_id;
    }

    /**
    * @return string
    */
    public function getName()
    {
        return $this->name;
    }

    /**
    * @return string
    */
    public function getWeight()
    {
        return $this->weight;
    }


}

