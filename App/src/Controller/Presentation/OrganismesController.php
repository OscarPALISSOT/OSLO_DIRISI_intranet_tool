<?php


namespace App\Controller\Presentation;

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


class OrganismesController extends AbstractController
{

    private $quartiersRepository;
    private $basesDeDefenseRepository;
    private $organismeRepository;

    public function __construct(QuartiersRepository $quartiersRepository, BasesDeDefenseRepository $basesDeDefenseRepository, OrganismeRepository $organismeRepository)
    {
        $this->quartiersRepository = $quartiersRepository;
        $this->basesDeDefenseRepository = $basesDeDefenseRepository;
        $this->organismeRepository = $organismeRepository;
    }

    /**
     * @Route ("/Organismes/{BaseDefense}/{trigramme}/{Orga}", name="Organisme")
     * @param Request $request
     * @return Response
     */

    public function index(Request $request): Response
    {
        $trigramme = $request->get('trigramme');
        $idBaseDefense = $request->get('BaseDefense');
        $idOrga = $request->get('Orga');
        $BaseDefense = $this->basesDeDefenseRepository->findOneBy([
            'idBaseDefense' => $idBaseDefense
        ]);

        $quartier = $this->quartiersRepository->findOneBy([
            'trigramme' => $trigramme,
            'idBaseDefense' => $BaseDefense,
        ]);
        $organisme = $this->organismeRepository->findOneBy([
            'idOrganisme' => $idOrga,
        ]);
        dump($BaseDefense);
        return $this->render('presentation/organisme.html.twig', [
            'Organisme' => $organisme,
            'BaseDefense' => $BaseDefense,
            'Quartier' => $quartier
        ]);
    }
}
