<?php

namespace App\Data;


use App\Entity\Organisme;
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

}