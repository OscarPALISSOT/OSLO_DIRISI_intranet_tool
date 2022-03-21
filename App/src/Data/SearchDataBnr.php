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
    public string $Bnr = '';


    /**
     * @var Priorisation[]
     */
    public $Priority;


    /**
     * @var bool
     */
    public bool $supMontant = true;


    /**
     * @var int
     */
    public int $Montant;

    /**
     * @var Organisme[]
     */
    public $idOrganisme;

    /**
     * @var Quartiers[]
     */
    public array $idQuartier;


    /**
     * @var bool | null
     */
    public bool $before;

    /**
     * @var \DateTime | null
     */
    public ?\DateTime $Echeance;


    /**
     * @var bool | null
     */
    public bool $state;

    /**
     * @var string
     */
    public string $comment = '';
}
