<?php

namespace App\Data;

use App\Entity\Organisme;
use App\Entity\Quartiers;
use Doctrine\Common\Collections\ArrayCollection;

class SearchDataBnr{

    /**
     * @var string
     */
    public string $Bnr = '';


    /**
     * @var bool
     */
    public bool $PriorityP1;

    /**
     * @var bool
     */
    public bool $PriorityP2;

    /**
     * @var bool
     */
    public bool $PriorityP3;

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
    public ArrayCollection $idOrganisme;

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
