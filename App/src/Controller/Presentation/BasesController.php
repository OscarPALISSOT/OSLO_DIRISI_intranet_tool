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


class BasesController extends AbstractController
{

    private $quartiersRepository;
    private $basesDeDefenseRepository;
    /**
     * @var InternetMilitaireRepository
     */
    private $internetMilitaireRepository;

    public function __construct(QuartiersRepository $quartiersRepository, BasesDeDefenseRepository $basesDeDefenseRepository, InternetMilitaireRepository $internetMilitaireRepository)
    {
        $this->quartiersRepository = $quartiersRepository;
        $this->basesDeDefenseRepository = $basesDeDefenseRepository;
        $this->internetMilitaireRepository = $internetMilitaireRepository;
    }

    /**
     * @Route ("/BaseDefense/{BaseDefense}", name="BaseDefense")
     * @param Request $request
     * @return Response
     */

    public function index(Request $request): Response
    {
        $idBaseDefense = $request->get('BaseDefense');
        $BaseDefense = $this->basesDeDefenseRepository->findOneBy([
            'idBaseDefense' => $idBaseDefense
        ]);

        $quartier = $this->quartiersRepository->findBy([
            'idBaseDefense' => $idBaseDefense,
        ]);

        $AccesWan = $this->accesWanRepository->findBy([
            'idQuartier' => $quartier->getIdQuartier(),
        ]);

        $InternetMilitaire = $this->internetMilitaireRepository->findByBase($idBaseDefense);
        return $this->render('presentation/baseDefense.html.twig', [
            'BaseDefense' => $BaseDefense,
            'Quartiers' => $quartier,
        ]);
    }
}