<?php


namespace App\Controller\Quartier;

use App\Entity\Organisme;
use App\Repository\BasesDeDefenseRepository;
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

    public function __construct(QuartiersRepository $quartiersRepository, BasesDeDefenseRepository $basesDeDefenseRepository, OrganismeRepository $organismeRepository)
    {
        $this->quartiersRepository = $quartiersRepository;
        $this->basesDeDefenseRepository = $basesDeDefenseRepository;
        $this->organismeRepository = $organismeRepository;
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
        return $this->render('quartiers/quartiers.html.twig', [
            'Quartier' => $quartier,
            'Organismes' => $organisme
        ]);
    }
}
