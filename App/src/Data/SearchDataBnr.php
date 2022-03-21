<?php

namespace App\Data;

use App\Entity\Organisme;
use App\Entity\Priorisation;
use App\Entity\Quartiers;

class SearchDataBnr{

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var string
     */
    public $Bnr = '';


    /**
     * @var Priorisation[]
     */
    public $Priority;


    /**
     * @var bool
     */
    public $supMontant = true;


    /**
     * @var int
     */
    public $Montant;

    /**
     * @var Organisme[]
     */
    public $idOrganisme;

    /**
     * @var Quartiers[]
     */
    public $idQuartier;


    /**
     * @var bool | null
     */
    public  $before;

    /**
     * @var \DateTime | null
     */
    public $Echeance;


    /**
     * @var bool | null
     */
    public $state;

    /**
     * @var string
     */
    public $comment = '';
}
