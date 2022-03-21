<?php

namespace App\Controller\gestion;

use App\Repository\AccesWanRepository;
use App\Repository\AffaireRepository;
use App\Repository\InfoBnrRepository;
use App\Repository\InfoModipRepository;
use App\Repository\InternetMilitaireRepository;
use App\Repository\SigleRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionController extends AbstractController {
    private $internetMilitaireRepository;
    private $sigleRepository;
    private $infoBnrRepository;
    private $infoModipRepository;
    private $accesWanRepository;

    public function __construct(InternetMilitaireRepository $internetMilitaireRepository, SigleRepository $sigleRepository, InfoBnrRepository $infoBnrRepository, InfoModipRepository $infoModipRepository, AccesWanRepository $accesWanRepository)
    {
        $this->internetMilitaireRepository = $internetMilitaireRepository;
        $this->sigleRepository = $sigleRepository;
        $this->infoBnrRepository = $infoBnrRepository;
        $this->infoModipRepository = $infoModipRepository;
        $this->accesWanRepository = $accesWanRepository;
    }


    /**
     * @Route ("/Gestion/{role}", name="Gestion")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) : Response{
        $role = $this->getUser()->getRoles();
        if ($role[0] == 'ROLE_ADMIN'){
            $role[0] = $request->get('role');

        }
        $sigles = $this->sigleRepository->findSigles();
        return $this->render('gestion/gestionHome.html.twig', [
            'nbBNR' => count($this->infoBnrRepository->findAll()),
            'nbMODIP' => count($this->infoModipRepository->findAll()),
            'nbMIM3' => count($this->internetMilitaireRepository->findAll()),
            'nbOPERA' => count($this->accesWanRepository->findAll()),
            'sigles' => $sigles,
            'role' => $role[0],
        ]);
    }


}