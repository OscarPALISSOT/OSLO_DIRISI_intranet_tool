<?php

namespace App\Repository;

use App\Entity\Priorisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Priorisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Priorisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Priorisation[]    findAll()
 * @method Priorisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriorisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Priorisation::class);
    }

    // /**
    //  * @return Priorisation[] Returns an array of Priorisation objects
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
    public function findOneBySomeField($value): ?Priorisation
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
