<?php

namespace App\Repository;

use App\Data\SearchDataAccesWan;
use App\Entity\AccesWan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method AccesWan|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccesWan|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccesWan[]    findAll()
 * @method AccesWan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccesWanRepository extends ServiceEntityRepository
{
    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, AccesWan::class);
        $this->paginator = $paginator;
    }

    /**
     * @param SearchDataAccesWan $data
     * @return PaginationInterface
     */
    public function findAccesWanSearch(SearchDataAccesWan $data): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('a')
            ->select('a', 'q')
            ->join('a.idQuartier', 'q')
            ->orderBy('a.updateAt', 'DESC');


        if (!empty($data->idQuartier)){
            $query = $query
                ->andWhere('a.idQuartier IN (:Quartier)')
                ->setParameter('Quartier', $data->idQuartier);
        }

        $query = $query->getQuery();

        return $this->paginator->paginate(
            $query,
            $data->page,
            12,
        );
    }

    // /**
    //  * @return AccesWan[] Returns an array of AccesWan objects
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
    public function findOneBySomeField($value): ?AccesWan
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
