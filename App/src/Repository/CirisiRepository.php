<?php

namespace App\Repository;

use App\Entity\Cirisi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cirisi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cirisi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cirisi[]    findAll()
 * @method Cirisi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CirisiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cirisi::class);
    }

     /**
      * @return Cirisi[] Returns an array of Cirisi objects
      */
    public function findAllWithBdd(): array
    {
        return $this->createQueryBuilder('c')
            ->innerJoin('c.idBaseDefense', 'b')
            ->addSelect('b')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Cirisi[] Returns an array of Cirisi objects
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
    public function findOneBySomeField($value): ?Cirisi
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
