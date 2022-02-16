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
    private InternetMilitaireRepository $internetMilitaireRepository;

    public function __construct(InternetMilitaireRepository $internetMilitaireRepository)
    {
        $this->internetMilitaireRepository = $internetMilitaireRepository;
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
        return $this->render('gestion/gestionHome.html.twig', [
            'nbBNR' => 'test',
            'nbMODIP' => 'test',
            'nbMIM3' => count($this->internetMilitaireRepository->findAll()),
            'nbOPERA' => 'test',
            'role' => $role[0],
        ]);
    }


}