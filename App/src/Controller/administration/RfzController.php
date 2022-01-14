<?php

namespace App\Controller\administration;

use App\Repository\RfzRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class RfzController extends AbstractController {

    public function __construct(Environment $twig, RfzRepository $Rfz)
    {
        $this->twig = $twig;
        $this->RfzRepository = $Rfz;
    }

    /**
     * @Route ("/Admin/RouteursFederateursDeZone", name="AdminRfz")
     * @return Response
     */
    public function index() : Response{
        return $this->render('administration/rfz.html.twig', [
            'Rfzs'=>$this->RfzRepository->findAll(),
        ]);
    }
}