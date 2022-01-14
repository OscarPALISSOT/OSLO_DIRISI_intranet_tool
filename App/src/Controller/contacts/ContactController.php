<?php

namespace App\Controller\contacts;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController {

    public function __construct()
    {
    }


    /**
     * @Route ("/Contact", name="contact")
     * @return Response
     */
    public function index() : Response{
        return $this->render('contacts/contact.html.twig', [

        ]);
    }


}