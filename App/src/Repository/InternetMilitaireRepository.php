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
    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, InternetMilitaire::class);
        $this->paginator = $paginator;
    }

    /**
     * @return InternetMilitaire[] Returns an array of InternetMilitaire objects
     */
    public function findMaxMontant(): array
    {
        return $this->createQueryBuilder('i')
            ->select('i.idInternetMilitaire', 'i.montantInternetMilitaire')
            ->orderBy('i.montantInternetMilitaire', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return InternetMilitaire[] Returns an array of InternetMilitaire objects
     */
    public function findMinMontant(): array
    {
        return $this->createQueryBuilder('i')
            ->select('i.idInternetMilitaire', 'i.montantInternetMilitaire')
            ->orderBy('i.montantInternetMilitaire', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }


    /**
     * @param SearchDataInternetMilitaire $data
     * @return PaginationInterface
     */
    public function findInternetMilitaireSearch(SearchDataInternetMilitaire $data): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('i')
            ->select('i')
            ->orderBy('i.updateAt', 'DESC');


        if (!empty($data->Montant)){
            if ($data->supMontant == false){
                $query = $query
                    ->andWhere('i.montantAffaire <= :Montant')
                    ->setParameter('Montant', $data->Montant);
            }
            else{
                $query = $query
                    ->andWhere('i.montantAffaire >= :Montant')
                    ->setParameter('Montant', $data->Montant);
            }
        }

        $query = $query->getQuery();

        return $this->paginator->paginate(
            $query,
            $data->page,
            12,
        );
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
