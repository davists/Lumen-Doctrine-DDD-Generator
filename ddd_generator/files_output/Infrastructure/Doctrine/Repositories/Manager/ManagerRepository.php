<?php
/**
 * Created by PhpStorm.
 * User: davi
 * Date: 2/26/17
 * Time: 12:35 AM
 */

namespace Infrastructure\Doctrine\Repositories\Manager;

use Domain\Manager\Entities\Manager;
use Doctrine\ORM\EntityManager;
use Domain\Manager\Contracts\ManagerRepositoryContract;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\DBAL\Query\Expression\CompositeExpression;

/**
 * Class ManagerRepository
 * @package Infrastructure\Doctrine\Repositories\Manager
 */
class ManagerRepository implements ManagerRepositoryContract
{
    /**
     * @var string
     */
    private $class = Manager::class;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * ManagerRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param Manager $manager
     */
    public function create(Manager $manager)
    {
        $this->em->persist($manager);
        $this->em->flush();
    }

    /**
     * @param Manager $manager
     * @param $data
     */
    public function update(Manager $manager, $data)
    {
        
		$manager->setManagerId($data['manager_id']);

		$manager->setName($data['name']);

		$manager->setWeight($data['weight']);

        $this->em->persist($manager);
        $this->em->flush();
    }

    /**
     * @param Manager $Manager
     */
    public function delete(Manager $manager)
    {
        $this->em->remove($manager);
        $this->em->flush();
    }

    /**
     * create Manager
     * @return Manager
     */
    public function load($data)
    {
        return new Manager($data);
    }

    /**
     * @param $id
     * @return null|object
     */
    public function findById($id)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'id' => $id
        ]);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->em->getRepository($this->class)->findAll();
    }

    /**
     * @param Manager $manager
     * @return array
     */
    public function toArray(Manager $manager)
    {
        return [
            
            "manager_id" => $manager->getManagerId(),
            "name" => $manager->getName(),
            "weight" => $manager->getWeight(),

        ];
    }


    /**
     * @param $dql
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function paginate($dql, $page = 1, $limit = 20)
    {
        $query = $this->em->createQuery($dql)
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        $paginator = new Paginator($query, $fetchJoinCollection = true);

        return $this->paginatorToArray($paginator);
    }

    /**
     * @param Paginator $paginator
     * @return array
     */
    public function paginatorToArray(Paginator $paginator)
    {
        $arrayResponse = [];

        foreach($paginator as $manager){
            $arrayResponse[] = $this->toArray($manager);
        }

        return $arrayResponse;
    }


    /**
     * @param array $filter
     * @return array
     */
    public function findByCriteria(array $filter)
    {
        $criteria = $this->addCriteria($filter);
        $result = $this->em->getRepository($this->class)->matching($criteria)->toArray();

        $arrayResponse = [];

        foreach ($result as $manager){
            $arrayResponse[]  = $this->toArray($manager);
        }

        return $arrayResponse;
    }

    /**
     * @param $filter
     * @return Criteria
     */
    public function addCriteria($filter)
    {
        $criteria = Criteria::create();
        $expr = Criteria::expr();

        if (count($filter)) {
            foreach ($filter as $expression => $comparison) {
                if(is_array($comparison[0])){
                    foreach ($comparison as $statement){

                        list($field, $operator, $value) = $statement;

                        if($field === "createdAt" || $field === "updatedAt"){
                            $value = new \DateTime($value);

                        }

                        if ($expression === 'or') {
                            $criteria->orWhere($expr->{$operator}($field,$value));
                        }

                        if ($expression === 'and') {
                            $criteria->andWhere($expr->{$operator}($field,$value));
                        }
                    }
                }
                else{
                    list($field, $operator, $value) = $comparison;
                    $criteria->where($expr->{$operator}($field,$value));
                }
            }
        }

        return $criteria;
    }


}