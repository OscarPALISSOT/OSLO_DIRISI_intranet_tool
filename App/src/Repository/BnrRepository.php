<?php

namespace App\Repository;

use App\Data\SearchDataBnr;
use App\Entity\Bnr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bnr|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bnr|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bnr[]    findAll()
 * @method Bnr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BnrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bnr::class);
    }

     /**
      * @return Bnr[] Returns an array of Bnr objects
      */
    public function findMaxMontant()
    {
        return $this->createQueryBuilder('b')
            ->select('b.idBnr', 'b.montantFeb')
            ->orderBy('b.montantFeb', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Bnr[] Returns an array of Bnr objects
     */
    public function findMinMontant()
    {
        return $this->createQueryBuilder('b')
            ->select('b.idBnr', 'b.montantFeb')
            ->orderBy('b.montantFeb', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

     /**
      * @return Bnr[] Returns an array of Bnr objects
      */
    public function findSearch(SearchDataBnr $data): array
    {
        $query = $this
            ->createQueryBuilder('b')
            ->select('b','o')
            ->join('b.idOrganisme', 'o');

        if (!empty($data->Bnr)){
            $query = $query
                ->andWhere('b.objBnr LIKE :Bnr')
                ->setParameter('Bnr', "%{$data->Bnr}%");
        }
        if (!empty($data->idOrganisme)){
            $query = $query
                ->andWhere('b.idOrganisme IN (:Organisme)')
                ->setParameter('Organisme', $data->idOrganisme->getIdOrganisme());
        }

        if (!empty($data->Montant)){
            if ($data->supMontant == false){
                $query = $query
                    ->andWhere('b.montantFeb <= :Montant')
                    ->setParameter('Montant', $data->Montant);
            }
            else{
                $query = $query
                    ->andWhere('b.montantFeb >= :Montant')
                    ->setParameter('Montant', $data->Montant);
            }
        }

        return $query->getQuery()->getResult();
    }


    // /**
    //  * @return Bnr[] Returns an array of Bnr objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bnr
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
