<?php

namespace App\Controller;

use App\Repository\BnrRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BNRController extends AbstractController {

    private BnrRepository $bnrRepository;

    public function __construct(BnrRepository $bnrRepository)
    {
        $this->bnrRepository = $bnrRepository;
    }


    /**
     * @Route ("/{role}/BNR", name="Bnr")
     * @return Response
     */
    public function index() : Response{
        return $this->render('pages/gestion.html.twig', [
            'BNRS' => $this->bnrRepository->findAll(),
        ]);
    }


}