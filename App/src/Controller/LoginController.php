<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController {

    public function __construct()
    {
    }


    /**
     * @Route ("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */

    public function login(AuthenticationUtils $authenticationUtils) : Response{

        $lastUsername = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('pages/login.html.twig', [
            'lastUsername' => $lastUsername,
            'error' => $error
        ]);
    }
}