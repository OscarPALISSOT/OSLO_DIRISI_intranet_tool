<?php

namespace App\Controller\administration;

use App\Repository\BasesDeDefenseRepository;
use App\Repository\RfzRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AdminController extends AbstractController {

    public function __construct(Environment $twig, BasesDeDefenseRepository $basesDeDefense, RfzRepository $Rfz)
    {
        $this->twig = $twig;
        $this->RfzRepository = $Rfz;
        $this->BasesDeDefenseRepository = $basesDeDefense;
    }

    /**
     * @Route ("/Admin", name="Admin")
     * @return Response
     */
    public function index() : Response{
        return $this->render('administration/admin.html.twig', [
            'nbBdd' => count($this->BasesDeDefenseRepository->findAll()),
            'nbRfz' => count($this->RfzRepository->findAll()),
        ]);
    }
}