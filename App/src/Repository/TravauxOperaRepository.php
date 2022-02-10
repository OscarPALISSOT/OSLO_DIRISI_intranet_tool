<?php

namespace App\Repository;

use App\Entity\TravauxOpera;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TravauxOpera|null find($id, $lockMode = null, $lockVersion = null)
 * @method TravauxOpera|null findOneBy(array $criteria, array $orderBy = null)
 * @method TravauxOpera[]    findAll()
 * @method TravauxOpera[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TravauxOperaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TravauxOpera::class);
    }

    // /**
    //  * @return TravauxOpera[] Returns an array of TravauxOpera objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TravauxOpera
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
