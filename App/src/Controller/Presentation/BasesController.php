<?php


namespace App\Controller\Presentation;

use App\Entity\Organisme;
use App\Repository\AccesWanRepository;
use App\Repository\AffaireRepository;
use App\Repository\BasesDeDefenseRepository;
use App\Repository\FebRepository;
use App\Repository\InfoBnrRepository;
use App\Repository\InternetMilitaireRepository;
use App\Repository\OrganismeRepository;
use App\Repository\QuartiersRepository;
use App\Repository\SigleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class BasesController extends AbstractController
{

    private $quartiersRepository;
    private $basesDeDefenseRepository;
    private $internetMilitaireRepository;
    private $accesWanRepository;
    private $sigleRepository;
    private $febRepository;
    private $affaireRepository;
    private $infoBnrRepository;

    public function __construct(QuartiersRepository $quartiersRepository, BasesDeDefenseRepository $basesDeDefenseRepository, InternetMilitaireRepository $internetMilitaireRepository, AccesWanRepository $accesWanRepository, SigleRepository $sigleRepository, FebRepository $febRepository, AffaireRepository $affaireRepository, InfoBnrRepository $infoBnrRepository)
    {
        $this->quartiersRepository = $quartiersRepository;
        $this->basesDeDefenseRepository = $basesDeDefenseRepository;
        $this->internetMilitaireRepository = $internetMilitaireRepository;
        $this->accesWanRepository = $accesWanRepository;
        $this->sigleRepository = $sigleRepository;
        $this->febRepository = $febRepository;
        $this->affaireRepository = $affaireRepository;
        $this->infoBnrRepository = $infoBnrRepository;
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

        $sigle = $this->sigleRepository->findSigles();

        $internetMilitaire = $this->internetMilitaireRepository->findByBase($idBaseDefense);

        $accesWan = $this->accesWanRepository->findOperaByBase($idBaseDefense);

        $feb = $this->febRepository->FindByBase($idBaseDefense);

        $affaire = $this->affaireRepository->FindByBase($idBaseDefense);

        $bnr = $this->infoBnrRepository->FindByBase($idBaseDefense);

        dump($bnr);

        return $this->render('presentation/baseDefense.html.twig', [
            'BaseDefense' => $BaseDefense,
            'Quartiers' => $quartier,
            'Sigle' => $sigle,
            'InternetMilitaires' => $internetMilitaire,
            'AccesWan' => $accesWan,
            'Feb' => $feb,
            'Affaire' => $affaire,
            'Bnr' => $bnr
        ]);
    }
}