<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ContactController extends AbstractController {

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    /**
     * @Route ("/Contact", name="contact")
     * @return Response
     */
    public function index() : Response{
        return $this->render('pages/contact.html.twig', [

        ]);
    }


}