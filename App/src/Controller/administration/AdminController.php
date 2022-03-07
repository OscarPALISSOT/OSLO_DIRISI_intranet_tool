<?php

namespace App\Controller\administration;

use App\Entity\BasesDeDefense;
use App\Entity\Cirisi;
use App\Entity\Organisme;
use App\Entity\Quartiers;
use App\Entity\Rfz;
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
use App\Repository\StatutPdcRepository;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
    private StatutPdcRepository $statutPdcRepository;

    public function __construct(BasesDeDefenseRepository $basesDeDefenseRepository, RfzRepository $RfzRepository, ContactRepository $contactRepository, CirisiRepository $cirisiRepository, QuartiersRepository $quartiersRepository, OrganismeRepository $organismeRepository, UsersRepository $usersRepository, SigleRepository $sigleRepository, GrandsComptesRepository $grandsComptesRepository, PriorisationRepository $priorisationRepository, NatureAffaireRepository $natureAffaireRepository, StatutPdcRepository $statutPdcRepository)
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
        $this->statutPdcRepository = $statutPdcRepository;
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
            'nbStatutPdc' => count($this->statutPdcRepository->findAll()),
        ]);
    }

    /**
     * @Route ("/Admin/ImportDataBase", name="importDatabase")
     * @param Request $request
     * @return JsonResponse
     */
    public function import(Request $request) : JsonResponse
    {

        $file = $request->files->get('file');

        $rfz = new Rfz();
        $rfz->setRfz('testRfz');

        $bdd = new BasesDeDefense();
        $bdd->setBaseDefense('testbdd');

        $cirisi = new Cirisi();
        $cirisi->setCirisi('testCirisi');

        $quartier = new Quartiers();
        $quartier->setQuartier('testQuartier');

        $organisme = new Organisme();
        $organisme->setOrganisme('testOrga');

        if ($file == null){
            $jsonData = array(
                'message' => "Erreur",
            );
        }
        else{
            $jsonData = array(
                'message' => "Importation terminée",
            );
        }



        return $this->json($jsonData, 200);
    }
}