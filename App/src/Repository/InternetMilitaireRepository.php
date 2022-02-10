<?php

namespace App\Repository;

use App\Entity\InternetMilitaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InternetMilitaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method InternetMilitaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method InternetMilitaire[]    findAll()
 * @method InternetMilitaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InternetMilitaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InternetMilitaire::class);
    }

    // /**
    //  * @return InternetMilitaire[] Returns an array of InternetMilitaire objects
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
    public function findOneBySomeField($value): ?InternetMilitaire
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
