<?php
/**
 * Created by PhpStorm.
 * User: davi
 * Date: 2/27/17
 * Time: 1:11 AM
 */
namespace Domain\Customer\Contracts;

use Domain\Customer\Entities\Order;

/**
 * Interface RepositoryContract
 */
interface OrderRepositoryContract{

    /**
     * @param Order $order
     * @return mixed
     */
    public function create(Order $order);

    /**
     * @param Order $order
     * @return mixed
     */
    public function update(Order $order, $data);

    /**
     * @param Order $order
     * @return mixed
     */
    public function delete(Order $order);

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
    public function toArray(Order $order);

    /**
     * @param $dql
     * @param $page
     * @param $limit
     * @return mixed
     */
    public function paginate($dql, $page=1, $limit=10);


}