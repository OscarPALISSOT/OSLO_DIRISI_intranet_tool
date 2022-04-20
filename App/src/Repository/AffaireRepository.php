<?php

namespace App\Repository;

use App\Data\SearchDataAffaire;
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
    private $paginator;

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

    /**
     * @param SearchDataAffaire $data
     * @return PaginationInterface
     */
    public function findAffaireSearch(SearchDataAffaire $data): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('a')
            ->select('a', 'p', 'n')
            ->join('a.idPriorisation', 'p')
            ->join('a.idNatureAffaire', 'n')
            ->andWhere('n.natureAffaire != :bnr and n.natureAffaire !=:modip and n.natureAffaire !=:febcom and n.natureAffaire !=:mim3')
            ->setParameters([
                'bnr'=> 'besoinNouveauReseau',
                'modip' => 'modifLan',
                'febcom' => 'ficheExpressionBesoinCOM',
                'mim3' => 'internet_militaire',
            ])
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



    public function FindByOrganisme($value)
    {
        return $this->createQueryBuilder('b')
            ->join('b.idFeb', 'f')
            ->join('f.idOrganisme', 'o')
            ->andWhere('o.idOrganisme = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

    public function FindByQuartier($value2)
    {
        return $this->createQueryBuilder('b')
            ->join('b.idFeb','f')
            ->join('f.idOrganisme','o')
            ->join('o.idQuartier','q')
            ->andWhere('q.idQuartier = :val2')
            ->setParameter('val2', $value2)
            ->getQuery()
            ->getResult();
    }

    public function FindByBase($value)
    {
        return $this->createQueryBuilder('b')
            ->join('b.idFeb','f')
            ->join('f.idOrganisme','o')
            ->join('o.idQuartier','q')
            ->join('q.idBaseDefense','a')
            ->andWhere('a.idBaseDefense = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

    public function FindByFeb($value)
    {
        return $this->createQueryBuilder('b')
            ->join('b.idFeb','f')
            ->andWhere('f.idFeb = :val')
            ->setParameter('val',$value)
            ->getQuery()
            ->getResult();
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
