<?php

namespace App\Controller\administration;

use App\Repository\BasesDeDefenseRepository;
use App\Repository\CirisiRepository;
use App\Repository\ContactRepository;
use App\Repository\GrandsComptesRepository;
use App\Repository\NatureAffaireRepository;
use App\Repository\OrganismeRepository;
use App\Repository\PriorisationRepository;
use App\Repository\QuartiersRepository;
use App\Repository\RfzRepository;
use App\Repository\SigleRepository;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController {

    private RfzRepository $RfzRepository;
    private BasesDeDefenseRepository $BasesDeDefenseRepository;
    private ContactRepository $ContactRepository;
    private CirisiRepository $cirisiRepository;
    private QuartiersRepository $quartiersRepository;
    private OrganismeRepository $organismeRepository;
    private UsersRepository $usersRepository;
    private SigleRepository $sigleRepository;
    private GrandsComptesRepository $grandsComptesRepository;
    private PriorisationRepository $priorisationRepository;
    private NatureAffaireRepository $natureAffaireRepository;

    public function __construct(BasesDeDefenseRepository $basesDeDefenseRepository, RfzRepository $RfzRepository, ContactRepository $contactRepository, CirisiRepository $cirisiRepository, QuartiersRepository $quartiersRepository, OrganismeRepository $organismeRepository, UsersRepository $usersRepository, SigleRepository $sigleRepository, GrandsComptesRepository $grandsComptesRepository, PriorisationRepository $priorisationRepository, NatureAffaireRepository $natureAffaireRepository)
    {
        $this->RfzRepository = $RfzRepository;
        $this->BasesDeDefenseRepository = $basesDeDefenseRepository;
        $this->ContactRepository = $contactRepository;
        $this->cirisiRepository = $cirisiRepository;
        $this->quartiersRepository = $quartiersRepository;
        $this->organismeRepository = $organismeRepository;
        $this->usersRepository = $usersRepository;
        $this->sigleRepository = $sigleRepository;
        $this->grandsComptesRepository = $grandsComptesRepository;
        $this->priorisationRepository = $priorisationRepository;
        $this->natureAffaireRepository = $natureAffaireRepository;
    }

    /**
     * @Route ("/Admin", name="Admin")
     * @return Response
     */
    public function index() : Response{
        return $this->render('administration/admin.html.twig', [
            'nbBdd' => count($this->BasesDeDefenseRepository->findAll()),
            'nbRfz' => count($this->RfzRepository->findAll()),
            'nbContact' => count($this->ContactRepository->findAll()),
            'nbCirisi' => count($this->cirisiRepository->findAll()),
            'nbQuartier' => count($this->quartiersRepository->findAll()),
            'nbOrganisme' => count($this->organismeRepository->findAll()),
            'nbUser' => count($this->usersRepository->findAll()),
            'nbSigle' => count($this->sigleRepository->findAll()),
            'nbPriorisation' => count($this->priorisationRepository->findAll()),
            'nbGrandComptes' => count($this->grandsComptesRepository->findAll()),
            'nbNatureAffaire' => count($this->natureAffaireRepository->findAll()),
        ]);
    }
}