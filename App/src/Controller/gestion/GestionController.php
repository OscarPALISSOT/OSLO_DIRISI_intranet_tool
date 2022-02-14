<?php

namespace App\Controller\gestion;

use App\Repository\BnrRepository;
use App\Repository\InternetMilitaireRepository;
use App\Repository\ModipRepository;
use App\Repository\OperaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionController extends AbstractController {

    private BnrRepository $bnrRepository;
    private ModipRepository $modipRepository;
    private InternetMilitaireRepository $internetMilitaireRepository;
    private OperaRepository $operaRepository;

    public function __construct(BnrRepository $bnrRepository, ModipRepository $modipRepository, InternetMilitaireRepository $internetMilitaireRepository, OperaRepository $operaRepository)
    {
        $this->bnrRepository = $bnrRepository;
        $this->modipRepository = $modipRepository;
        $this->internetMilitaireRepository = $internetMilitaireRepository;
        $this->operaRepository = $operaRepository;
    }


    /**
     * @Route ("/Gestion/{role}", name="Gestion")
     * @return Response
     */
    public function index(Request $request) : Response{
        $role = $this->getUser()->getRoles();
        if ($role[0] == 'ROLE_ADMIN'){
            $role[0] = $request->get('role');

        }
        return $this->render('gestion/gestionHome.html.twig', [
            'nbBNR' => count($this->bnrRepository->findAll()),
            'nbMODIP' => count($this->modipRepository->findAll()),
            'nbMIM3' => count($this->internetMilitaireRepository->findAll()),
            'nbOPERA' => count($this->operaRepository->findAll()),
            'role' => $role[0],
        ]);
    }


}