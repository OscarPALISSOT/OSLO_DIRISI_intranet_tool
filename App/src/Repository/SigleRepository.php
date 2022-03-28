<?php

namespace App\Repository;

use App\Entity\Sigle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sigle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sigle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sigle[]    findAll()
 * @method Sigle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SigleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sigle::class);
    }


    /**
     * @return array
     * return array of all the acronym with their titles
     */
    public function findSigles(): array
    {
        $sigleEntity = $this->findAll();
        $sigles = [];
        foreach ($sigleEntity as $item) {
            $sigles[$item->getIntituleSigle()] = $item->getSigle();
        }
        if (!array_key_exists('internet_militaire', $sigles)) {
            $sigles['internet_militaire'] = 'Internet militaire';
        }
        if (!array_key_exists('accesWan', $sigles)) {
            $sigles['accesWan'] = 'Accès wan';
        }
        if (!array_key_exists('modifLan', $sigles)) {
            $sigles['modifLan'] = 'Modification lan';
        }
        if (!array_key_exists('besoinNouveauReseau', $sigles)) {
            $sigles['besoinNouveauReseau'] = 'Besoin nouveau réseau';
        }
        if (!array_key_exists('ficheExpressionBesoinCOM', $sigles)) {
            $sigles['ficheExpressionBesoinCOM'] = 'Fiche expression besoin COM';
        }
        return $sigles;
    }

     /**
      * @return Sigle[] Returns an array of Sigle objects
      */

    public function findNatureSigles()
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.intituleSigle = :bnr OR s.intituleSigle =:modip OR s.intituleSigle =:febcom OR s.intituleSigle =:mim3')
            ->setParameters([
                'bnr'=> 'besoinNouveauReseau',
                'modip' => 'modifLan',
                'febcom' => 'ficheExpressionBesoinCOM',
                'mim3' => 'internet_militaire',
            ])
            ->getQuery()
            ->getResult()
        ;
    }


    // /**
    //  * @return Sigle[] Returns an array of Sigle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sigle
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
