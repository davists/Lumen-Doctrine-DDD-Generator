<?php
/**
 * Created by PhpStorm.
 * User: davi
 * Date: 2/26/17
 * Time: 12:35 AM
 */

namespace Infrastructure\Doctrine\Repositories\Offer;

use Domain\Manager\Entities\Offer;
use Doctrine\ORM\EntityManager;
use Domain\Manager\Contracts\OfferRepositoryContract;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\DBAL\Query\Expression\CompositeExpression;

/**
 * Class OfferRepository
 * @package Infrastructure\Doctrine\Repositories\Offer
 */
class OfferRepository implements OfferRepositoryContract
{
    /**
     * @var string
     */
    private $class = Offer::class;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * OfferRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param Offer $offer
     */
    public function create(Offer $offer)
    {
        $this->em->persist($offer);
        $this->em->flush();
    }

    /**
     * @param Offer $offer
     * @param $data
     */
    public function update(Offer $offer, $data)
    {
        
		$offer->setOfferId($data['offer_id']);

		$offer->setOfferName($data['offer_name']);

		$offer->setOfferWeight($data['offer_weight']);

		$offer->setOfferSharp($data['offer_sharp']);

        $this->em->persist($offer);
        $this->em->flush();
    }

    /**
     * @param Offer $Offer
     */
    public function delete(Offer $offer)
    {
        $this->em->remove($offer);
        $this->em->flush();
    }

    /**
     * create Offer
     * @return Offer
     */
    public function load($data)
    {
        return new Offer($data);
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
     * @param Offer $offer
     * @return array
     */
    public function toArray(Offer $offer)
    {
        return [
            
            "offer_id" => $offer->getOfferId(),
            "offer_name" => $offer->getOfferName(),
            "offer_weight" => $offer->getOfferWeight(),
            "offer_sharp" => $offer->getOfferSharp(),

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

        foreach($paginator as $offer){
            $arrayResponse[] = $this->toArray($offer);
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

        foreach ($result as $offer){
            $arrayResponse[]  = $this->toArray($offer);
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