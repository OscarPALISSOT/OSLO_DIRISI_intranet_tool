<?php

namespace App\Repository;

use App\Entity\ContactCirisi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContactCirisi|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactCirisi|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactCirisi[]    findAll()
 * @method ContactCirisi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactCirisiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactCirisi::class);
    }

    // /**
    //  * @return ContactCirisi[] Returns an array of ContactCirisi objects
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
    public function findOneBySomeField($value): ?ContactCirisi
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
