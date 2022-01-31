<?php

namespace App\Controller;

use App\Repository\BnrRepository;
use App\Repository\InternetMilitaireRepository;
use App\Repository\ModipRepository;
use App\Repository\OperaRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BRCController extends AbstractController {

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
     * @Route ("/BRC", name="brc")
     * @return Response
     */
    public function index() : Response{
        return $this->render('pages/BRC.html.twig', [
            'nbBNR' => count($this->bnrRepository->findAll()),
            'nbMODIP' => count($this->modipRepository->findAll()),
            'nbMIM3' => count($this->internetMilitaireRepository->findAll()),
            'nbOPERA' => count($this->operaRepository->findAll()),
        ]);
    }


}