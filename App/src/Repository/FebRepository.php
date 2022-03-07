<?php

namespace App\Repository;

use App\Entity\Feb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Feb|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feb|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feb[]    findAll()
 * @method Feb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FebRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Feb::class);
    }

    /**
     * @return Feb[] Returns an array of Feb objects
     */
    public function findMaxMontant(): array
    {
        return $this->createQueryBuilder('f')
            ->select('f.idFeb', 'f.montantFeb')
            ->orderBy('f.montantFeb', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Feb[] Returns an array of Feb objects
     */
    public function findMinMontant(): array
    {
        return $this->createQueryBuilder('f')
            ->select('f.idFeb', 'f.montantFeb')
            ->orderBy('f.montantFeb', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Feb[] Returns an array of Feb objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Feb
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
