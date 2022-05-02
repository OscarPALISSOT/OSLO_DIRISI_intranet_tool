<?php

namespace App\Repository;

use App\Data\SearchDataFeb;
use App\Entity\Feb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Feb|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feb|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feb[]    findAll()
 * @method Feb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FebRepository extends ServiceEntityRepository
{
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Feb::class);
        $this->paginator = $paginator;
    }

    /**
     * @return Feb[] Returns an array of Feb objects
     */
    public function findMaxMontant(): array
    {
        return $this->createQueryBuilder('f')
            ->select('f.idFeb', 'f.montantFeb')
            ->orderBy('f.montantFeb', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Feb[] Returns an array of Feb objects
     */
    public function findMinMontant(): array
    {
        return $this->createQueryBuilder('f')
            ->select('f.idFeb', 'f.montantFeb')
            ->orderBy('f.montantFeb', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param SearchDataFeb $data
     * @return PaginationInterface
     */
    public function findFebSearch(SearchDataFeb $data): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('f')
            ->select('f','p')
            ->join('f.idPdc', 'p')
            ->orderBy('f.updateat', 'DESC');


        if (!empty($data->Feb)){
            $query = $query
                ->andWhere('f.numFeb LIKE :Feb')
                ->setParameter('Feb', "%{$data->Feb}%");
        }
        if (!empty($data->Pdc) && count($data->Pdc) > 0){
            $query = $query
                ->andWhere('f.idPdc IN (:idPdc)')
                ->setParameter('idPdc', $data->Pdc);
        }

        if (!empty($data->Montant)){
            if ($data->supMontant == false){
                $query = $query
                    ->andWhere('f.montantFeb <= :Montant')
                    ->setParameter('Montant', $data->Montant);
            }
            else{
                $query = $query
                    ->andWhere('f.montantFeb >= :Montant')
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


    public function FindByOrganisme($value)
    {
        return $this->createQueryBuilder('i')
            ->join('i.idPdc','p')
            ->join('p.idOrganisme','o')
            ->where('o.idOrganisme = :val')
            ->setParameter('val',$value)
            ->getQuery()
            ->getResult()
            ;
    }


    public function FindByBase($value)
    {
        return $this->createQueryBuilder('i')
            ->join('i.idPdc','p')
            ->join('p.idOrganisme','o')
            ->join('o.idQuartier','q')
            ->where('q.idBaseDefense = :val')
            ->setParameter('val',$value)
            ->getQuery()
            ->getResult()
            ;
    }

    public function FindByQuartier($value)
    {
        return $this->createQueryBuilder('i')
            ->join('i.idPdc','p')
            ->join('p.idOrganisme','o')
            ->where('o.idQuartier = :val')
            ->setParameter('val',$value)
            ->getQuery()
            ->getResult()
            ;
    }



  /*
    public function findFebByOrganismes($value) {
        return $this->createQueryBuilder('o')
            ->join('o.idQuartier','q')
            ->join('q.idOrganisme','a')
            ->where('a.IdBaseDefense = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
            ;
    }
*/

    // /**
    //  * @return Feb[] Returns an array of Feb objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Feb
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
