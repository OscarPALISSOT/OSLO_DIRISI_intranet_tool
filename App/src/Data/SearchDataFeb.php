<?php

namespace App\Data;

use App\Entity\PlanDeCharge;

class SearchDataFeb{

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var string
     */
    public string $Feb = '';


    /**
     * @var PlanDeCharge[]
     */
    public $Pdc;


    /**
     * @var bool
     */
    public bool $supMontant = true;


    /**
     * @var int
     */
    public int $Montant;
}