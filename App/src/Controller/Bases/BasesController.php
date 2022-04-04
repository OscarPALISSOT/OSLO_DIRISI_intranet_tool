<?php


namespace App\Controller\Bases;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class BasesController extends AbstractController
{

    public function __construct()
    {
    }

    /**
     * @Route ("/base", name="base")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('Bases/Bases.html.twig', [

        ]);
    }
}
