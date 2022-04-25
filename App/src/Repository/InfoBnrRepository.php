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
    private $paginator;

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
            ->select('i', 'a', 'p')
            ->join('i.idAffaire', 'a')
            ->join('a.idPriorisation', 'p')
            ->orderBy('a.updateAt', 'DESC');


        if (!empty($data->Bnr)){
            $query = $query
                ->andWhere('a.nomAffaire LIKE :Bnr')
                ->setParameter('Bnr', "%{$data->Bnr}%");
        }

        if (!empty($data->Priority) && count($data->Priority) > 0){
            $query = $query
                ->andWhere('p.idPriorisation IN (:Priorisation)')
                ->setParameter('Priorisation', $data->Priority);
        }

        if (!empty($data->Montant)){
            if ($data->supMontant == false){
                $query = $query
                    ->andWhere('a.montantAffaire <= :Montant')
                    ->setParameter('Montant', $data->Montant);
            }
            else{
                $query = $query
                    ->andWhere('a.montantAffaire >= :Montant')
                    ->setParameter('Montant', $data->Montant);
            }
        }

        $query = $query->getQuery();

        return $this->paginator->paginate(
            $query,
            $data->page,
            12
        );


    }

    public function FindByBase($value)
    {
        return $this->createQueryBuilder('i')
            ->join('i.idAffaire','a')
            ->join('a.idFeb','f')
            ->join('f.idOrganisme','o')
            ->join('o.idQuartier','q')
            ->join('q.idBaseDefense','b')
            ->andWhere('b.idBaseDefense = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

    public function FindByQuartier($value)
    {
        return $this->createQueryBuilder('i')
            ->join('i.idAffaire','a')
            ->join('a.idFeb','f')
            ->join('f.idOrganisme','o')
            ->join('o.idQuartier','q')
            ->andWhere('q.idQuartier = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

    public function FindByOrganisme($value)
    {
        return $this->createQueryBuilder('i')
            ->join('i.idAffaire','a')
            ->join('a.idFeb','f')
            ->join('f.idOrganisme','o')
            ->andWhere('o.idOrganisme = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
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
