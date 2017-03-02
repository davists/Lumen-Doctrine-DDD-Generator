<?php
/**
 * Created by DDDGenerator
 * By davi dos santos - davi646@gmail.com
 */

namespace Application\Core\Services\Customer;

use Domain\Customer\Contracts\CustomerRepositoryContract;

/**
 * Class CustomerService
 * @package Application\Core\Services\Customer
 */
class CustomerService
{
    /**
     * @var CustomerRepositoryContract
     */
    private $repository;

    /**
     * CustomerService constructor.
     * @param CustomerRepositoryContract $repository
     */
    public function __construct(CustomerRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $data
     * @return array
     */
    public function createCustomer($data)
    {
        $customer = $this->repository->load($data);
        $this->repository->create($customer);

        return  $response = [
            'status'=>'200',
            'message' => 'success',
            'data' => 'customer saved successfully'
        ];
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getByPage($page,$limit)
    {
        $sql = "SELECT u FROM Domain\Customer\Entities\Customer u ";
        $pagination = $this->repository->paginate($sql,$page,$limit);

        return  $response = [
            'status'=>'200',
            'message' => $pagination,
            'data' => 'customers retrieved successfully'
        ];
    }

    public function getByFilter($criteria)
    {
        $filter = $this->repository->findByCriteria($criteria);

        return  $response = [
            'status'=>'200',
            'message' => 'customers retrieved successfully',
            'data' => $filter,
        ];
    }

}