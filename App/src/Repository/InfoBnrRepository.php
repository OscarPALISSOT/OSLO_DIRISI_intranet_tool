<?php

namespace App\Repository;

use App\Entity\InfoBnr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InfoBnr|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoBnr|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoBnr[]    findAll()
 * @method InfoBnr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoBnrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfoBnr::class);
    }

    // /**
    //  * @return InfoBnr[] Returns an array of InfoBnr objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InfoBnr
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
