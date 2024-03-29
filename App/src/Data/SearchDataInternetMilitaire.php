<?php

namespace App\Data;


use App\Entity\BasesDeDefense;
use App\Entity\Organisme;
use App\Entity\Quartiers;
use App\Entity\SupportInternetMilitaire;

class SearchDataInternetMilitaire{

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var Organisme[]
     */
    public $idOrganisme;

    /**
     * @var SupportInternetMilitaire[]
     */

    public $idSupport;
    /**
     * @var BasesDeDefense[]
     */
    public $idBaseDeDefense;

    /**
     * @var Quartiers[]
     */
    public $idQuartier;

    /**
     * @var bool
     */
    public $supDebit = true;


    /**
     * @var int
     */
    public $Debit;

}