<?php

namespace App\Repository;

use App\Data\SearchDataPdc;
use App\Entity\PlanDeCharge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method PlanDeCharge|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanDeCharge|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanDeCharge[]    findAll()
 * @method PlanDeCharge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanDeChargeRepository extends ServiceEntityRepository
{
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, PlanDeCharge::class);
        $this->paginator = $paginator;
    }


    /**
     * @return PlanDeCharge[] Returns an array of Feb objects
     */
    public function findMaxMontant(): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.idPdc', 'p.montantPdc')
            ->orderBy('p.montantPdc', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return PlanDeCharge[] Returns an array of Feb objects
     */
    public function findMinMontant(): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.idPdc', 'p.montantPdc')
            ->orderBy('p.montantPdc', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param SearchDataPdc $data
     * @return PaginationInterface
     */
    public function findPdcSearch(SearchDataPdc $data): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('p')
            ->select('p', 's', 'e', 'g')
            ->join('p.idStatutPdc', 's')
            ->join('p.idEtatPdc', 'e')
            ->join('p.idGrandsComptes', 'g')
            ->orderBy('p.updateat', 'DESC');


        if (!empty($data->Pdc)){
            $query = $query
                ->andWhere('p.intitulePdc LIKE :Pdc')
                ->setParameter('Pdc', "%{$data->Pdc}%");
        }

        if (!empty($data->num)){
            $query = $query
                ->andWhere('p.numPdc LIKE :Pdc')
                ->setParameter('Pdc', "%{$data->num}%");
        }

        if (!empty($data->StatutPdc) && count($data->StatutPdc) > 0){
            $query = $query
                ->andWhere('p.idStatutPdc IN (:idStatutPdc)')
                ->setParameter('idStatutPdc', $data->StatutPdc);
        }

        if (!empty($data->EtatPdc) && count($data->EtatPdc) > 0){
            $query = $query
                ->andWhere('p.idEtatPdc IN (:idEtatPdc)')
                ->setParameter('idEtatPdc', $data->EtatPdc);
        }

        if (!empty($data->GrandsComptes) && count($data->GrandsComptes) > 0){
            $query = $query
                ->andWhere('p.idGrandsComptes IN (:idGrandsComptes)')
                ->setParameter('idGrandsComptes', $data->GrandsComptes);
        }

        if (!empty($data->Montant)){
            if ($data->supMontant == false){
                $query = $query
                    ->andWhere('p.montantPdc <= :Montant')
                    ->setParameter('Montant', $data->Montant);
            }
            else{
                $query = $query
                    ->andWhere('p.montantPdc >= :Montant')
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
    //  * @return PlanDeCharge[] Returns an array of PlanDeCharge objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlanDeCharge
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
