<?php
/**
 * Created by DDDGenerator
 * By davi dos santos - davi646@gmail.com
 */

namespace Application\Core\Services\Manager;

use Domain\Manager\Contracts\ManagerRepositoryContract;

/**
 * Class ManagerService
 * @package Application\Core\Services\Manager
 */
class ManagerService
{
    /**
     * @var ManagerRepositoryContract
     */
    private $repository;

    /**
     * ManagerService constructor.
     * @param ManagerRepositoryContract $repository
     */
    public function __construct(ManagerRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $data
     * @return array
     */
    public function createManager($data)
    {
        $manager = $this->repository->load($data);
        $this->repository->create($manager);

        return  $response = [
            'status'=>'200',
            'message' => 'success',
            'data' => 'manager saved successfully'
        ];
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getByPage($page,$limit)
    {
        $sql = "SELECT u FROM Domain\Manager\Entities\Manager u ";
        $pagination = $this->repository->paginate($sql,$page,$limit);

        return  $response = [
            'status'=>'200',
            'message' => $pagination,
            'data' => 'managers retrieved successfully'
        ];
    }

    public function getByFilter($criteria)
    {
        $filter = $this->repository->findByCriteria($criteria);

        return  $response = [
            'status'=>'200',
            'message' => 'managers retrieved successfully',
            'data' => $filter,
        ];
    }

}