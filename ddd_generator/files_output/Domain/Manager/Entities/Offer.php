<?php

namespace Domain\Manager\Entities;

/**
 * Offer
 */
class Offer
{
    
    /**
    * @var integer
    */
    private $offer_id;

    /**
    * @var string
    */
    private $offer_name;

    /**
    * @var string
    */
    private $offer_weight;

    /**
    * @var integer
    */
    private $offer_sharp;

    /**
     * Offer constructor.
     * @param $data
     */
    public function __construct($data)
    {
        //your business logic
     }
    
    /**
    * @param integer $offer_id
    */ 
    public function setOfferId($offer_id)
    {
        $this->offer_id = $offer_id;
    }

    /**
    * @param string $offer_name
    */ 
    public function setOfferName($offer_name)
    {
        $this->offer_name = $offer_name;
    }

    /**
    * @param string $offer_weight
    */ 
    public function setOfferWeight($offer_weight)
    {
        $this->offer_weight = $offer_weight;
    }

    /**
    * @param integer $offer_sharp
    */ 
    public function setOfferSharp($offer_sharp)
    {
        $this->offer_sharp = $offer_sharp;
    }

    
    /**
    * @return integer
    */
    public function getOfferId()
    {
        return $this->offer_id;
    }

    /**
    * @return string
    */
    public function getOfferName()
    {
        return $this->offer_name;
    }

    /**
    * @return string
    */
    public function getOfferWeight()
    {
        return $this->offer_weight;
    }

    /**
    * @return integer
    */
    public function getOfferSharp()
    {
        return $this->offer_sharp;
    }


}

