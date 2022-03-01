<?php

namespace App\Controller\gestion;

use App\Repository\AffaireRepository;
use App\Repository\InfoBnrRepository;
use App\Repository\InternetMilitaireRepository;
use App\Repository\SigleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionController extends AbstractController {
    private InternetMilitaireRepository $internetMilitaireRepository;
    private SigleRepository $sigleRepository;
    private AffaireRepository $affaireRepository;
    private InfoBnrRepository $infoBnrRepository;

    public function __construct(InternetMilitaireRepository $internetMilitaireRepository, SigleRepository $sigleRepository, AffaireRepository $affaireRepository, InfoBnrRepository $infoBnrRepository)
    {
        $this->internetMilitaireRepository = $internetMilitaireRepository;
        $this->sigleRepository = $sigleRepository;
        $this->affaireRepository = $affaireRepository;
        $this->infoBnrRepository = $infoBnrRepository;
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
            'nbMODIP' => 'test',
            'nbMIM3' => count($this->internetMilitaireRepository->findAll()),
            'nbOPERA' => 'test',
            'sigles' => $sigles,
            'role' => $role[0],
        ]);
    }


}