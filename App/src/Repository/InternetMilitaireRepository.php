<?php

namespace App\Repository;

use App\Data\SearchDataInternetMilitaire;
use App\Entity\InternetMilitaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method InternetMilitaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method InternetMilitaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method InternetMilitaire[]    findAll()
 * @method InternetMilitaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InternetMilitaireRepository extends ServiceEntityRepository
{
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, InternetMilitaire::class);
        $this->paginator = $paginator;
    }

    /**
     * @param SearchDataInternetMilitaire $data
     * @return PaginationInterface
     */
    public function findInternetMilitaireSearch(SearchDataInternetMilitaire $data): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('i')
            ->select('i', 'o', 's', 'q', 'b')
            ->join('i.idOrganisme', 'o')
            ->join('i.idSupport', 's')
            ->join('o.idQuartier', 'q')
            ->join('q.idBaseDefense', 'b')
            ->orderBy('i.updateAt', 'DESC');


        if (!empty($data->idOrganisme) && count($data->idOrganisme) > 0){
            $query = $query
                ->andWhere('o.idOrganisme IN (:Organisme)')
                ->setParameter('Organisme', $data->idOrganisme);
        }
        if (!empty($data->idSupport) && count($data->idSupport) > 0){
            $query = $query
                ->andWhere('i.idSupport IN (:Support)')
                ->setParameter('Support', $data->idSupport);
        }
        if (!empty($data->idBaseDeDefense) && count($data->idBaseDeDefense) > 0){
            $query = $query
                ->andWhere('b.idBaseDefense IN (:BaseDeDefense)')
                ->setParameter('BaseDeDefense', $data->idBaseDeDefense);
        }
        if (!empty($data->idQuartier) && count($data->idQuartier) > 0){
            $query = $query
                ->andWhere('q.idQuartier IN (:Quartier)')
                ->setParameter('Quartier', $data->idQuartier);
        }

        if (!empty($data->Debit)){
            if ($data->supDebit == false){
                $query = $query
                    ->andWhere('f.montantFeb <= :Montant')
                    ->setParameter('Montant', $data->Debit);
            }
            else{
                $query = $query
                    ->andWhere('f.montantFeb >= :Montant')
                    ->setParameter('Montant', $data->Debit);
            }
        }

        $query = $query->getQuery();

        return $this->paginator->paginate(
            $query,
            $data->page,
            12
        );
    }


     /**
      * @return InternetMilitaire[] Returns an array of InternetMilitaire objects
      */

    public function findByQuartier($value)
    {
        return $this->createQueryBuilder('i')
            ->join('i.idOrganisme', 'o')
            ->andWhere('o.idQuartier = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByBase($value)
    {
        return $this->createQueryBuilder('i')
            ->join('i.idOrganisme', 'o')
            ->join('o.idQuartier', 'q')
            ->Where('q.idBaseDefense = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return InternetMilitaire[] Returns an array of InternetMilitaire objects
     */
    public function findMaxDebit(): array
    {
        return $this->createQueryBuilder('i')
            ->select('i.idInternetMilitaire', 'i.debitInternetMilitaire')
            ->orderBy('i.debitInternetMilitaire', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return InternetMilitaire[] Returns an array of InternetMilitaire objects
     */
    public function findMinDebit(): array
    {
        return $this->createQueryBuilder('i')
            ->select('i.idInternetMilitaire', 'i.debitInternetMilitaire')
            ->orderBy('i.debitInternetMilitaire', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
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
