<?php

namespace App\Repository;

use App\Entity\Contactbdd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contactbdd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contactbdd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contactbdd[]    findAll()
 * @method Contactbdd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactbddRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contactbdd::class);
    }


     /**
      * @return Contactbdd[] Returns an array of Contactbdd objects
      */
    public function findAllWithBdd()
    {
        return $this->createQueryBuilder('cb')
            ->innerJoin('cb.idContact', 'c')
            ->addSelect('c')
            ->innerJoin('cb.idBaseDefense', 'Bdd')
            ->addSelect('Bdd')
            ->orderBy('cb.idBaseDefense', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Contactbdd[] Returns an array of Contactbdd objects
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
    public function findOneBySomeField($value): ?Contactbdd
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
