<?php

namespace App\Data;

use App\Entity\BasesDeDefense;
use App\Entity\Organisme;
use App\Entity\Quartiers;
use Doctrine\Common\Collections\ArrayCollection;

class SearchDataModip{

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var string
     */
    public $Bnr = '';


    /**
     * @var bool
     */
    public $PriorityP1;

    /**
     * @var bool
     */
    public $PriorityP2;

    /**
     * @var bool
     */
    public $PriorityP3;

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
     * @var BasesDeDefense[]
     */
    public $idBaseDeDefense;


    /**
     * @var bool | null
     */
    public $before;

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
