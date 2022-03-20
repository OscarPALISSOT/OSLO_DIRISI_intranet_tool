<?php

namespace App\Repository;

use App\Entity\TravauxAccesWan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TravauxAccesWan|null find($id, $lockMode = null, $lockVersion = null)
 * @method TravauxAccesWan|null findOneBy(array $criteria, array $orderBy = null)
 * @method TravauxAccesWan[]    findAll()
 * @method TravauxAccesWan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TravauxAccesWanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TravauxAccesWan::class);
    }

    // /**
    //  * @return TravauxAccesWan[] Returns an array of TravauxAccesWan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TravauxAccesWan
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
