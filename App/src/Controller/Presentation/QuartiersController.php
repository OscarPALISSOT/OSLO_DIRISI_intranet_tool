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


class QuartiersController extends AbstractController
{

    private $quartiersRepository;
    private $basesDeDefenseRepository;
    private $organismeRepository;
    private $accesWanRepository;
    private $internetMilitaireRepository;
    private $sigleRepository;
    private $febRepository;
    private $affaireRepository;
    private $infoBnrRepository;

    public function __construct(QuartiersRepository $quartiersRepository, BasesDeDefenseRepository $basesDeDefenseRepository, OrganismeRepository $organismeRepository, AccesWanRepository $accesWanRepository, InternetMilitaireRepository $internetMilitaireRepository, SigleRepository $sigleRepository, FebRepository $febRepository, AffaireRepository $affaireRepository, InfoBnrRepository $infoBnrRepository)
    {
        $this->quartiersRepository = $quartiersRepository;
        $this->basesDeDefenseRepository = $basesDeDefenseRepository;
        $this->organismeRepository = $organismeRepository;
        $this->accesWanRepository = $accesWanRepository;
        $this->internetMilitaireRepository = $internetMilitaireRepository;
        $this->sigleRepository = $sigleRepository;
        $this->febRepository = $febRepository;
        $this->affaireRepository = $affaireRepository;
        $this->infoBnrRepository = $infoBnrRepository;
    }

    /**
     * @Route ("/Quartier/{BaseDefense}/{trigramme}", name="Quartier")
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

        $sigle = $this->sigleRepository->findSigles();

        $InternetMilitaire = $this->internetMilitaireRepository->findByQuartier($quartier->getIdQuartier());

        $feb = $this->febRepository->FindByQuartier($quartier->getIdQuartier());

        $affaire = $this->affaireRepository->FindByQuartier($quartier->getIdQuartier());

        $bnr = $this->infoBnrRepository->FindByQuartier($quartier->getIdQuartier());

        return $this->render('presentation/quartiers.html.twig', [
            'Quartier' => $quartier,
            'Organismes' => $organisme,
            'AccesWan' => $AccesWan,
            'InternetMilitaires' => $InternetMilitaire,
            'Sigle' => $sigle,
            'Feb' => $feb,
            'Affaire' => $affaire,
            'Bnr' => $bnr
        ]);
    }
}
