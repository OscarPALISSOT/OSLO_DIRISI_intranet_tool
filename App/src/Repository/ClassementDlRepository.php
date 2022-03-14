<?php

namespace App\Repository;

use App\Entity\ClassementDl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClassementDl|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassementDl|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassementDl[]    findAll()
 * @method ClassementDl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassementDlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassementDl::class);
    }

    // /**
    //  * @return ClassementDl[] Returns an array of ClassementDl objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClassementDl
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
