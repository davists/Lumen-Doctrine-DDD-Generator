<?php
/**
 * Created by PhpStorm.
 * User: davi
 * Date: 2/27/17
 * Time: 1:11 AM
 */
namespace Domain\Manager\Contracts;

use Domain\Manager\Entities\Offer;

/**
 * Interface RepositoryContract
 */
interface OfferRepositoryContract{

    /**
     * @param Offer $offer
     * @return mixed
     */
    public function create(Offer $offer);

    /**
     * @param Offer $offer
     * @return mixed
     */
    public function update(Offer $offer, $data);

    /**
     * @param Offer $offer
     * @return mixed
     */
    public function delete(Offer $offer);

    /**
     * @param $data
     * @return mixed
     */
    public function load($data);

    /**
     * @return mixed
     */
    public function findById($id);

    /**
     * @return mixed
     */
    public function findByCriteria(array $criteria);

    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @return mixed
     */
    public function toArray(Offer $offer);

    /**
     * @param $dql
     * @param $page
     * @param $limit
     * @return mixed
     */
    public function paginate($dql, $page=1, $limit=10);


}