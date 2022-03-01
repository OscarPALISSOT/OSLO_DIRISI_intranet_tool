<?php

namespace App\Repository;

use App\Data\SearchDataBnr;
use App\Entity\InfoBnr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method InfoBnr|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoBnr|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoBnr[]    findAll()
 * @method InfoBnr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoBnrRepository extends ServiceEntityRepository
{
    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, InfoBnr::class);
        $this->paginator = $paginator;
    }

    /**
     * @param SearchDataBnr $data
     * @return PaginationInterface
     */
    public function findBnrSearch(SearchDataBnr $data): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('i')
            ->select('i','o', 'a')
            ->join('i.idAffaire', 'a')
            ->join('a.idOrganisme', 'o')
            ->orderBy('a.updateAt', 'DESC');


        if (!empty($data->Bnr)){
            $query = $query
                ->andWhere('i.objBnr LIKE :Bnr')
                ->setParameter('Bnr', "%{$data->Bnr}%");
        }
        if (!empty($data->idOrganisme)){
            $query = $query
                ->andWhere('i.idOrganisme IN (:Organisme)')
                ->setParameter('Organisme', $data->idOrganisme->getIdOrganisme());
        }

        if (!empty($data->Montant)){
            if ($data->supMontant == false){
                $query = $query
                    ->andWhere('i.montantFeb <= :Montant')
                    ->setParameter('Montant', $data->Montant);
            }
            else{
                $query = $query
                    ->andWhere('i.montantFeb >= :Montant')
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
    //  * @return InfoBnr[] Returns an array of InfoBnr objects
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
    public function findOneBySomeField($value): ?InfoBnr
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
