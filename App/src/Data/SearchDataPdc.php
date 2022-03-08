<?php

namespace App\Data;

use App\Entity\PlanDeCharge;
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
     * @var StatutPdc[]
     */
    public $StatutPdc;


    /**
     * @var bool
     */
    public bool $supMontant = true;


    /**
     * @var int
     */
    public int $Montant;
}
