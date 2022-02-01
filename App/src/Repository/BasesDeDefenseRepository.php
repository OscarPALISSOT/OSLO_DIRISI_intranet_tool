<?php

namespace App\Repository;

use App\Entity\BasesDeDefense;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BasesDeDefense|null find($id, $lockMode = null, $lockVersion = null)
 * @method BasesDeDefense|null findOneBy(array $criteria, array $orderBy = null)
 * @method BasesDeDefense[]    findAll()
 * @method BasesDeDefense[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BasesDeDefenseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BasesDeDefense::class);
    }

     /**
      * @return Query
      */
    public function findAllWithRfzQuery(): Query
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.idRfz', 'r')
            ->addSelect('r')
            ->getQuery()
        ;
    }

    // /**
    //  * @return BasesDeDefense[] Returns an array of BasesDeDefense objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BasesDeDefense
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
