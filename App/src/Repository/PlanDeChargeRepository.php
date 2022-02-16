<?php

namespace App\Repository;

use App\Entity\PlanDeCharge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlanDeCharge|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanDeCharge|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanDeCharge[]    findAll()
 * @method PlanDeCharge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanDeChargeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanDeCharge::class);
    }

    // /**
    //  * @return PlanDeCharge[] Returns an array of PlanDeCharge objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlanDeCharge
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
