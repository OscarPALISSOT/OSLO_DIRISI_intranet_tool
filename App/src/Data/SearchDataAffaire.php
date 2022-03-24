<?php

namespace App\Data;


use App\Entity\BasesDeDefense;
use App\Entity\Organisme;
use App\Entity\SupportInternetMilitaire;

class SearchDataAffaire{

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var Organisme[]
     */
    public $idOrganisme;

    /**
     * @var BasesDeDefense[]
     */
    public $idBaseDeDefense;

}