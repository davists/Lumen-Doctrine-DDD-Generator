<?php
/**
 * Created by PhpStorm.
 * User: davi
 * Date: 2/27/17
 * Time: 1:11 AM
 */
namespace Domain\Customer\Contracts;

use Domain\Customer\Entities\Customer;

/**
 * Interface RepositoryContract
 */
interface CustomerRepositoryContract{

    /**
     * @param Customer $customer
     * @return mixed
     */
    public function create(Customer $customer);

    /**
     * @param Customer $customer
     * @return mixed
     */
    public function update(Customer $customer, $data);

    /**
     * @param Customer $customer
     * @return mixed
     */
    public function delete(Customer $customer);

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
    public function toArray(Customer $customer);

    /**
     * @param $dql
     * @param $page
     * @param $limit
     * @return mixed
     */
    public function paginate($dql, $page=1, $limit=10);


}