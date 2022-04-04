<?php


namespace App\Controller\Bases;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class QuartiersController extends AbstractController
{

    public function __construct()
    {
    }

    /**
     * @Route ("/quartiers/{trigramme}", name="quartiers")
     * @return Response
     */

    public function index(Request $request): Response
    {
        $trigramme = $request->get('trigramme');
        return $this->render('quartiers/quartiers.html.twig', [

        ]);
    }
}
