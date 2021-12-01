<?php

namespace App\Repository;

use App\Entity\LivretHeure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LivretHeure|null find($id, $lockMode = null, $lockVersion = null)
 * @method LivretHeure|null findOneBy(array $criteria, array $orderBy = null)
 * @method LivretHeure[]    findAll()
 * @method LivretHeure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivretHeureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LivretHeure::class);
    }

     /**
      * @return LivretHeure[] Returns an array of LivretHeure objects
      */

    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }



    public function findOneBySomeField($value): ?LivretHeure
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
