<?php

namespace App\Controller\administration;

use App\Repository\BasesDeDefenseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class BddController extends AbstractController {

    public function __construct(Environment $twig, BasesDeDefenseRepository $basesDeDefense)
    {
        $this->twig = $twig;
        $this->BasesDeDefenseRepository = $basesDeDefense;
    }

    /**
     * @Route ("/Admin/BasesDeDefense", name="AdminBdd")
     * @return Response
     */
    public function index() : Response{
        return $this->render('administration/bdd.html.twig', [
            'Bdds'=>$this->BasesDeDefenseRepository->findAll(),
        ]);
    }
}