<?php

namespace App\Repository;

use App\Entity\Modip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Modip|null find($id, $lockMode = null, $lockVersion = null)
 * @method Modip|null findOneBy(array $criteria, array $orderBy = null)
 * @method Modip[]    findAll()
 * @method Modip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Modip::class);
    }

    // /**
    //  * @return Modip[] Returns an array of Modip objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Modip
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
