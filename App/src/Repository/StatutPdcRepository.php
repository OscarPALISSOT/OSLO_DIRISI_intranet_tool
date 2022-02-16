<?php

namespace App\Repository;

use App\Entity\StatutPdc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatutPdc|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatutPdc|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatutPdc[]    findAll()
 * @method StatutPdc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatutPdcRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatutPdc::class);
    }

    // /**
    //  * @return StatutPdc[] Returns an array of StatutPdc objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatutPdc
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
