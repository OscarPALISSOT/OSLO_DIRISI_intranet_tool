<?php

namespace App\Repository;

use App\Entity\InfoModip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InfoModip|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoModip|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoModip[]    findAll()
 * @method InfoModip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoModipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfoModip::class);
    }

    // /**
    //  * @return InfoModip[] Returns an array of InfoModip objects
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
    public function findOneBySomeField($value): ?InfoModip
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
