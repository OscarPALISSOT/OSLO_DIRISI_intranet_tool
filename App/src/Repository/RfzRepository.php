<?php

namespace App\Repository;

use App\Entity\Rfz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rfz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rfz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rfz[]    findAll()
 * @method Rfz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RfzRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rfz::class);
    }

    // /**
    //  * @return Rfz[] Returns an array of Rfz objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rfz
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
