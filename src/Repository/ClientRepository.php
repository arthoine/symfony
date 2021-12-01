<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\Tools\Pagination\Paginator;


/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    /*public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

     /**
        * @return Client[] Returns an array of Client objects
      */

    /*public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }



    public function findOneBySomeField($value): ?Client
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }*/

///////////////////////////////////////////////////////////////////////////////////////////
    public const ITEMS_PER_PAGE = 20;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    /**
     * @param int $page
     * @return Paginator
     */
    public function findPaginatedResults(int $page = 1)
    {
        $page = max(0, $page - 1);
        $query = $this->createQueryBuilder('a')
            ->addOrderBy('a.actif', 'DESC')
            ->addOrderBy('a.id', 'DESC')
            ->setMaxResults(self::ITEMS_PER_PAGE)
            ->setFirstResult($page * self::ITEMS_PER_PAGE)
            ->getQuery()
        ;

        return new Paginator($query);
    }
}
