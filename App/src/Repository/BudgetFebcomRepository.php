<?php

namespace App\Repository;

use App\Entity\BudgetFebcom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BudgetFebcom|null find($id, $lockMode = null, $lockVersion = null)
 * @method BudgetFebcom|null findOneBy(array $criteria, array $orderBy = null)
 * @method BudgetFebcom[]    findAll()
 * @method BudgetFebcom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BudgetFebcomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BudgetFebcom::class);
    }

    // /**
    //  * @return BudgetFebcom[] Returns an array of BudgetFebcom objects
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
    public function findOneBySomeField($value): ?BudgetFebcom
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
