<?php


namespace App\Controller\Presentation;

use App\Entity\Organisme;
use App\Repository\AccesWanRepository;
use App\Repository\AffaireRepository;
use App\Repository\BasesDeDefenseRepository;
use App\Repository\FebRepository;
use App\Repository\InfoBnrRepository;
use App\Repository\InfoModipRepository;
use App\Repository\InternetMilitaireRepository;
use App\Repository\OrganismeRepository;
use App\Repository\QuartiersRepository;
use App\Repository\SigleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class OrganismesController extends AbstractController

{
    private $quartiersRepository;
    private $basesDeDefenseRepository;
    private $organismeRepository;
    private $sigleRepository;
    private $internetMilitaireRepository;
    private $accesWanRepository;
    private $febRepository;
    private $affaireRepository;
    private $infoBnrRepository;
    private $infoModipRepository;

    public function __construct(QuartiersRepository $quartiersRepository, BasesDeDefenseRepository $basesDeDefenseRepository, OrganismeRepository $organismeRepository, SigleRepository $sigleRepository, InternetMilitaireRepository $internetMilitaireRepository, AccesWanRepository $accesWanRepository, FebRepository $febRepository, AffaireRepository $affaireRepository, InfoBnrRepository $infoBnrRepository, InfoModipRepository $infoModipRepository)
    {
        $this->quartiersRepository = $quartiersRepository;
        $this->basesDeDefenseRepository = $basesDeDefenseRepository;
        $this->organismeRepository = $organismeRepository;
        $this->sigleRepository = $sigleRepository;
        $this->internetMilitaireRepository = $internetMilitaireRepository;
        $this->accesWanRepository = $accesWanRepository;
        $this->febRepository = $febRepository;
        $this->affaireRepository = $affaireRepository;
        $this->infoBnrRepository = $infoBnrRepository;
        $this->infoModipRepository = $infoModipRepository;
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

        $sigle = $this->sigleRepository->findSigles();

        $internetMilitaire = $this->internetMilitaireRepository->findBy([
            'idOrganisme' => $organisme->getIdOrganisme(),
        ]);

        $accesWan = $this->accesWanRepository->findBy([
            'idQuartier' => $quartier->getIdQuartier(),
        ]);

        $feb = $this->febRepository->FindByOrganisme($organisme);

        $affaire = $this->affaireRepository->FindByOrganisme($organisme);

        $bnr = $this->infoBnrRepository->FindByOrganisme($organisme);

        $modip = $this->infoModipRepository->FindByOrganisme($organisme);


        return $this->render('presentation/organisme.html.twig', [
            'Organisme' => $organisme,
            'BaseDefense' => $BaseDefense,
            'Quartier' => $quartier,
            'Sigle' => $sigle,
            'InternetMilitaires' => $internetMilitaire,
            'AccesWan' => $accesWan,
            'Feb' => $feb,
            'Affaire' => $affaire,
            'Bnr' => $bnr,
            'Modip' => $modip
        ]);
    }
}
