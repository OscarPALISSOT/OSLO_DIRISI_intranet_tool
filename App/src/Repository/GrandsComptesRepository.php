<?php

namespace App\Repository;

use App\Entity\GrandsComptes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GrandsComptes|null find($id, $lockMode = null, $lockVersion = null)
 * @method GrandsComptes|null findOneBy(array $criteria, array $orderBy = null)
 * @method GrandsComptes[]    findAll()
 * @method GrandsComptes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrandsComptesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GrandsComptes::class);
    }

    // /**
    //  * @return GrandsComptes[] Returns an array of GrandsComptes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GrandsComptes
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
