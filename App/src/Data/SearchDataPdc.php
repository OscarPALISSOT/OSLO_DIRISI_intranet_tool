<?php

namespace App\Data;

use App\Entity\EtatPdc;
use App\Entity\GrandsComptes;
use App\Entity\StatutPdc;

class SearchDataPdc{

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var string
     */
    public string $Pdc = '';

    /**
     * @var string
     */
    public string $num = '';


    /**
     * @var StatutPdc[]
     */
    public $StatutPdc;

    /**
     * @var EtatPdc[]
     */
    public $EtatPdc;

    /**
     * @var GrandsComptes[]
     */
    public $GrandsComptes;


    /**
     * @var bool
     */
    public bool $supMontant = true;


    /**
     * @var int
     */
    public int $Montant;
}
