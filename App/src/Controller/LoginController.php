<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController {

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
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