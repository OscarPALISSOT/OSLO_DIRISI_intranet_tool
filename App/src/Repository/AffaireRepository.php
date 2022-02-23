<?php

namespace App\Repository;

use App\Data\SearchDataBnr;
use App\Entity\Affaire;
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
    private SigleRepository $sigleRepository;
    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, SigleRepository $sigleRepository, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Affaire::class);
        $this->sigleRepository = $sigleRepository;
        $this->paginator = $paginator;
    }

    /**
     * @return Bnr[] Returns an array of Bnr objects
     */
    public function findMaxMontant(): array
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
    public function findMinMontant(): array
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
     * @return Affaire[] Returns an array of Affaire objects
     */
    public function findAllBnr(): array
    {
        $Nature = $this->sigleRepository->findOneBy([
            'intituleSigle' => 'besoinNouveauReseau'
        ]);

        $query = $this
            ->createQueryBuilder('a')
            ->select('a', 'n')
            ->join('a.idNatureAffaire', 'n')
            ->andWhere('a.idNatureAffaire = :val')
            ->setParameter('val', $Nature->getSigle());

        return $query->getQuery()->getResult();
    }

    /**
     * @param SearchDataBnr $data
     * @return PaginationInterface
     */
    public function findBnrSearch(SearchDataBnr $data): PaginationInterface
    {
        $Nature = $this->sigleRepository->findOneBy([
            'intituleSigle' => 'besoinNouveauReseau'
        ]);

        $query = $this
            ->createQueryBuilder('a')
            ->select('a','o', 'n')
            ->join('a.idOrganisme', 'o')
            ->join('a.idNatureAffaire', 'n')
            ->andWhere('a.idNatureAffaire = :val')
            ->setParameter('val', $Nature->getSigle());

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

        $query = $query->getQuery();

        return $this->paginator->paginate(
            $query,
            $data->page,
            12,
        );
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
