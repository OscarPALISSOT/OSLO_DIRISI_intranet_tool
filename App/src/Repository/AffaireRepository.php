<?php

namespace App\Repository;

use App\Data\SearchDataBnr;
use App\Entity\Affaire;
use App\Entity\NatureAffaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Affaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Affaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Affaire[]    findAll()
 * @method Affaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffaireRepository extends ServiceEntityRepository
{
    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Affaire::class);
        $this->paginator = $paginator;
    }

    /**
     * @return Affaire[] Returns an array of Bnr objects
     */
    public function findMaxMontant(): array
    {
        return $this->createQueryBuilder('a')
            ->select('a.idAffaire', 'a.montantAffaire')
            ->orderBy('a.montantAffaire', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Affaire[] Returns an array of Bnr objects
     */
    public function findMinMontant(): array
    {
        return $this->createQueryBuilder('a')
            ->select('a.idAffaire', 'a.montantAffaire')
            ->orderBy('a.montantAffaire', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }



    // /**
    //  * @return Affaire[] Returns an array of Affaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Affaire
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
