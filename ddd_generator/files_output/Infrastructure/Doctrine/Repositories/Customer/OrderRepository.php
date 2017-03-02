<?php
/**
 * Created by PhpStorm.
 * User: davi
 * Date: 2/26/17
 * Time: 12:35 AM
 */

namespace Infrastructure\Doctrine\Repositories\Order;

use Domain\Customer\Entities\Order;
use Doctrine\ORM\EntityManager;
use Domain\Customer\Contracts\OrderRepositoryContract;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\DBAL\Query\Expression\CompositeExpression;

/**
 * Class OrderRepository
 * @package Infrastructure\Doctrine\Repositories\Order
 */
class OrderRepository implements OrderRepositoryContract
{
    /**
     * @var string
     */
    private $class = Order::class;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * OrderRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param Order $order
     */
    public function create(Order $order)
    {
        $this->em->persist($order);
        $this->em->flush();
    }

    /**
     * @param Order $order
     * @param $data
     */
    public function update(Order $order, $data)
    {
        
		$order->setOrderId($data['order_id']);

		$order->setOrderName($data['order_name']);

		$order->setOrderWeight($data['order_weight']);

        $this->em->persist($order);
        $this->em->flush();
    }

    /**
     * @param Order $Order
     */
    public function delete(Order $order)
    {
        $this->em->remove($order);
        $this->em->flush();
    }

    /**
     * create Order
     * @return Order
     */
    public function load($data)
    {
        return new Order($data);
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
     * @param Order $order
     * @return array
     */
    public function toArray(Order $order)
    {
        return [
            
            "order_id" => $order->getOrderId(),
            "order_name" => $order->getOrderName(),
            "order_weight" => $order->getOrderWeight(),

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

        foreach($paginator as $order){
            $arrayResponse[] = $this->toArray($order);
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

        foreach ($result as $order){
            $arrayResponse[]  = $this->toArray($order);
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