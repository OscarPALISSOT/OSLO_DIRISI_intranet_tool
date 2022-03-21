<?php

namespace App\Repository;

use App\Data\SearchDataModip;
use App\Entity\InfoModip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method InfoModip|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoModip|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoModip[]    findAll()
 * @method InfoModip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoModipRepository extends ServiceEntityRepository
{
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, InfoModip::class);
        $this->paginator = $paginator;
    }

    /**
     * @param SearchDataModip $data
     * @return PaginationInterface
     */
    public function findModipSearch(SearchDataModip $data): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('i')
            ->select('i', 'a')
            ->join('i.idAffaire', 'a')
            ->orderBy('a.updateAt', 'DESC');


        if (!empty($data->Bnr)){
            $query = $query
                ->andWhere('a.nomAffaire LIKE :Bnr')
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

    // /**
    //  * @return InfoModip[] Returns an array of InfoModip objects
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
    public function findOneBySomeField($value): ?InfoModip
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
