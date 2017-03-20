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
    * @var integer
    */
    private $manager_id;

    /**
    * @var integer
    */
    private $service_id;

    /**
    * @var string
    */
    private $schedule_week_days;

    /**
    * @var string
    */
    private $schedule_start_date;

    /**
    * @var string
    */
    private $schedule_end_date;

    /**
    * @var string
    */
    private $schedule_start_hour;

    /**
    * @var string
    */
    private $schedule_end_hour;

    /**
    * @var string
    */
    private $price;

    /**
    * @var string
    */
    private $discount;

    /**
    * @var string
    */
    private $discount_expiration_date;

    /**
    * @var string
    */
    private $estimated_duration_hours;

    /**
    * @var string
    */
    private $estimated_duration_hours;

    /**
    * @var string
    */
    private $schedule_deadline;

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
    * @param integer $manager_id
    */ 
    public function setManagerId($manager_id)
    {
        $this->manager_id = $manager_id;
    }

    /**
    * @param integer $service_id
    */ 
    public function setServiceId($service_id)
    {
        $this->service_id = $service_id;
    }

    /**
    * @param string $schedule_week_days
    */ 
    public function setScheduleWeekDays($schedule_week_days)
    {
        $this->schedule_week_days = $schedule_week_days;
    }

    /**
    * @param string $schedule_start_date
    */ 
    public function setScheduleStartDate($schedule_start_date)
    {
        $this->schedule_start_date = $schedule_start_date;
    }

    /**
    * @param string $schedule_end_date
    */ 
    public function setScheduleEndDate($schedule_end_date)
    {
        $this->schedule_end_date = $schedule_end_date;
    }

    /**
    * @param string $schedule_start_hour
    */ 
    public function setScheduleStartHour($schedule_start_hour)
    {
        $this->schedule_start_hour = $schedule_start_hour;
    }

    /**
    * @param string $schedule_end_hour
    */ 
    public function setScheduleEndHour($schedule_end_hour)
    {
        $this->schedule_end_hour = $schedule_end_hour;
    }

    /**
    * @param string $price
    */ 
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
    * @param string $discount
    */ 
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    /**
    * @param string $discount_expiration_date
    */ 
    public function setDiscountExpirationDate($discount_expiration_date)
    {
        $this->discount_expiration_date = $discount_expiration_date;
    }

    /**
    * @param string $estimated_duration_hours
    */ 
    public function setEstimatedDurationHours($estimated_duration_hours)
    {
        $this->estimated_duration_hours = $estimated_duration_hours;
    }

    /**
    * @param string $estimated_duration_hours
    */ 
    public function setEstimatedDurationHours($estimated_duration_hours)
    {
        $this->estimated_duration_hours = $estimated_duration_hours;
    }

    /**
    * @param string $schedule_deadline
    */ 
    public function setScheduleDeadline($schedule_deadline)
    {
        $this->schedule_deadline = $schedule_deadline;
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
    public function getOfferId()
    {
        return $this->offer_id;
    }

    /**
    * @return integer
    */
    public function getManagerId()
    {
        return $this->manager_id;
    }

    /**
    * @return integer
    */
    public function getServiceId()
    {
        return $this->service_id;
    }

    /**
    * @return string
    */
    public function getScheduleWeekDays()
    {
        return $this->schedule_week_days;
    }

    /**
    * @return string
    */
    public function getScheduleStartDate()
    {
        return $this->schedule_start_date;
    }

    /**
    * @return string
    */
    public function getScheduleEndDate()
    {
        return $this->schedule_end_date;
    }

    /**
    * @return string
    */
    public function getScheduleStartHour()
    {
        return $this->schedule_start_hour;
    }

    /**
    * @return string
    */
    public function getScheduleEndHour()
    {
        return $this->schedule_end_hour;
    }

    /**
    * @return string
    */
    public function getPrice()
    {
        return $this->price;
    }

    /**
    * @return string
    */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
    * @return string
    */
    public function getDiscountExpirationDate()
    {
        return $this->discount_expiration_date;
    }

    /**
    * @return string
    */
    public function getEstimatedDurationHours()
    {
        return $this->estimated_duration_hours;
    }

    /**
    * @return string
    */
    public function getEstimatedDurationHours()
    {
        return $this->estimated_duration_hours;
    }

    /**
    * @return string
    */
    public function getScheduleDeadline()
    {
        return $this->schedule_deadline;
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

