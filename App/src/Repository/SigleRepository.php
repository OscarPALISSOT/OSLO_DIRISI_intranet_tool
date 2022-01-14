<?php

namespace App\Repository;

use App\Entity\Sigle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sigle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sigle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sigle[]    findAll()
 * @method Sigle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SigleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sigle::class);
    }

    // /**
    //  * @return Sigle[] Returns an array of Sigle objects
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
    public function findOneBySomeField($value): ?Sigle
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
