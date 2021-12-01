<?php

namespace App\Repository;

use App\Entity\EssenceGNR;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EssenceGNR|null find($id, $lockMode = null, $lockVersion = null)
 * @method EssenceGNR|null findOneBy(array $criteria, array $orderBy = null)
 * @method EssenceGNR[]    findAll()
 * @method EssenceGNR[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EssenceGNRRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EssenceGNR::class);
    }

     /**
      * @return EssenceGNR[] Returns an array of EssenceGNR objects
      */

    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }



    public function findOneBySomeField($value): ?EssenceGNR
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }



}
