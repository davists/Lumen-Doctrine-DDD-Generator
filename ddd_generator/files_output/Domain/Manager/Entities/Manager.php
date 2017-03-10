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
    * @var \DateTime
    */
    private $createdAt;

    /**
    * @var \DateTime
    */
    private $updatedAt;

    /**
    * @var \DateTime
    */
    private $deletedAt;

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
    * @param \DateTime $createdAt
    */ 
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = new \DateTime($createdAt);
    }

    /**
    * @param \DateTime $updatedAt
    */ 
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = new \DateTime($updatedAt);
    }

    /**
    * @param \DateTime $deletedAt
    */ 
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = new \DateTime($deletedAt);
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

    /**
    * @return \DateTime
    */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
    * @return \DateTime
    */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
    * @return \DateTime
    */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }


}

