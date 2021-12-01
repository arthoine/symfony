<?php

namespace App\Repository;

use App\Entity\Vehicule2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\Tools\Pagination\Paginator;


/**
 * @method Vehicule2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicule2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicule2[]    findAll()
 * @method Vehicule2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Vehicule2Repository extends ServiceEntityRepository
{
    /*public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule2::class);
    }

    // /**
    //  * @return Vehicule2[] Returns an array of Vehicule2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vehicule2
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    ///////////////////////////////////////////////////////////////////////////////////////////
    public const ITEMS_PER_PAGE = 20;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule2::class);
    }

    /**
     * @param int $page
     * @return Paginator
     */
    public function findPaginatedResults(int $page = 1)
    {
        $page = max(0, $page - 1);
        $query = $this->createQueryBuilder('a')

            ->addOrderBy('a.id', 'DESC')
            ->setMaxResults(self::ITEMS_PER_PAGE)
            ->setFirstResult($page * self::ITEMS_PER_PAGE)
            ->getQuery()
        ;

        return new Paginator($query);
    }
}
