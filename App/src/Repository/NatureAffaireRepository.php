<?php

namespace App\Repository;

use App\Entity\NatureAffaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NatureAffaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method NatureAffaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method NatureAffaire[]    findAll()
 * @method NatureAffaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatureAffaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NatureAffaire::class);
    }


    /**
     * @return NatureAffaire[] Returns an array of Sigle objects
     */

    public function findAffairesNature()
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.natureAffaire != :bnr and n.natureAffaire !=:modip and n.natureAffaire !=:febcom and n.natureAffaire !=:mim3')
            ->setParameters([
                'bnr'=> 'besoinNouveauReseau',
                'modip' => 'modifLan',
                'febcom' => 'ficheExpressionBesoinCOM',
                'mim3' => 'internet_militaire',
            ])
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return NatureAffaire[] Returns an array of NatureAffaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NatureAffaire
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
