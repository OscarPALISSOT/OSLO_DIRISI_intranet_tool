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
    public $Feb = '';


    /**
     * @var PlanDeCharge[]
     */
    public $Pdc;


    /**
     * @var bool
     */
    public $supMontant = true;


    /**
     * @var int
     */
    public $Montant;
}