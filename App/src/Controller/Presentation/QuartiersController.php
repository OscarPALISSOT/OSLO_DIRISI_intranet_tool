<?php


namespace App\Controller\Quartier;

use App\Entity\Organisme;
use App\Repository\AccesWanRepository;
use App\Repository\BasesDeDefenseRepository;
use App\Repository\InternetMilitaireRepository;
use App\Repository\OrganismeRepository;
use App\Repository\QuartiersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class QuartiersController extends AbstractController
{

    private $quartiersRepository;
    private $basesDeDefenseRepository;
    private $organismeRepository;
    private $accesWanRepository;
    private $internetMilitaireRepository;

    public function __construct(QuartiersRepository $quartiersRepository, BasesDeDefenseRepository $basesDeDefenseRepository, OrganismeRepository $organismeRepository, AccesWanRepository $accesWanRepository, InternetMilitaireRepository $internetMilitaireRepository)
    {
        $this->quartiersRepository = $quartiersRepository;
        $this->basesDeDefenseRepository = $basesDeDefenseRepository;
        $this->organismeRepository = $organismeRepository;
        $this->accesWanRepository = $accesWanRepository;
        $this->internetMilitaireRepository = $internetMilitaireRepository;
    }

    /**
     * @Route ("/quartier/{BaseDefense}/{trigramme}", name="quartier")
     * @param Request $request
     * @return Response
     */

    public function index(Request $request): Response
    {
        $trigramme = $request->get('trigramme');
        $idBaseDefense = $request->get('BaseDefense');
        $BaseDefense = $this->basesDeDefenseRepository->findOneBy([
            'idBaseDefense' => $idBaseDefense
        ]);

        $quartier = $this->quartiersRepository->findOneBy([
            'trigramme' => $trigramme,
            'idBaseDefense' => $BaseDefense,
        ]);
        $organisme = $this->organismeRepository->findBy([
            'idQuartier' => $quartier->getIdQuartier(),
        ]);

        $AccesWan = $this->accesWanRepository->findBy([
            'idQuartier' => $quartier->getIdQuartier(),
        ]);
        $InternetMilitaire = $this->internetMilitaireRepository->findByQuartier($quartier->getIdQuartier());
        return $this->render('quartiers/quartiers.html.twig', [
            'Quartiers' => $quartier,
            'Organismes' => $organisme,
            'AccesWans' => $AccesWan,
            'InternetMilitaires' => $InternetMilitaire
        ]);
    }
}
