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
     * @param SearchDataInternetMilitaire $data
     * @return PaginationInterface
     */
    public function findInternetMilitaireSearch(SearchDataInternetMilitaire $data): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('i')
            ->select('i', 'o')
            ->join('i.idOrganisme', 'o')
            ->orderBy('i.updateAt', 'DESC');


        if (!empty($data->idOrganisme)){
            $query = $query
                ->andWhere('i.idOrganisme IN (:Organisme)')
                ->setParameter('Organisme', $data->idOrganisme);
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
