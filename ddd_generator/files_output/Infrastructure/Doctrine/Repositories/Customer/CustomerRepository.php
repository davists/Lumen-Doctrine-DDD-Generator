<?php
/**
 * Created by PhpStorm.
 * User: davi
 * Date: 2/26/17
 * Time: 12:35 AM
 */

namespace Infrastructure\Doctrine\Repositories\Customer;

use Domain\Customer\Entities\Customer;
use Doctrine\ORM\EntityManager;
use Domain\Customer\Contracts\CustomerRepositoryContract;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\DBAL\Query\Expression\CompositeExpression;

/**
 * Class CustomerRepository
 * @package Infrastructure\Doctrine\Repositories\Customer
 */
class CustomerRepository implements CustomerRepositoryContract
{
    /**
     * @var string
     */
    private $class = Customer::class;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * CustomerRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param Customer $customer
     */
    public function create(Customer $customer)
    {
        $this->em->persist($customer);
        $this->em->flush();
    }

    /**
     * @param Customer $customer
     * @param $data
     */
    public function update(Customer $customer, $data)
    {
        
		$customer->setCustomerId($data['customer_id']);

		$customer->setCustomerName($data['customer_name']);

		$customer->setCustomerWeight($data['customer_weight']);

        $this->em->persist($customer);
        $this->em->flush();
    }

    /**
     * @param Customer $Customer
     */
    public function delete(Customer $customer)
    {
        $this->em->remove($customer);
        $this->em->flush();
    }

    /**
     * create Customer
     * @return Customer
     */
    public function load($data)
    {
        return new Customer($data);
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
     * @param Customer $customer
     * @return array
     */
    public function toArray(Customer $customer)
    {
        return [
            
            "customer_id" => $customer->getCustomerId(),
            "customer_name" => $customer->getCustomerName(),
            "customer_weight" => $customer->getCustomerWeight(),

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

        foreach($paginator as $customer){
            $arrayResponse[] = $this->toArray($customer);
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

        foreach ($result as $customer){
            $arrayResponse[]  = $this->toArray($customer);
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