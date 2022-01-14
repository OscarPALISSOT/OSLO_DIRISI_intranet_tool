<?php

namespace App\Controller\administration;

use App\Repository\BasesDeDefenseRepository;
use App\Repository\ContactRepository;
use App\Repository\RfzRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController {

    private RfzRepository $RfzRepository;
    private BasesDeDefenseRepository $BasesDeDefenseRepository;
    private ContactRepository $ContactRepository;

    public function __construct(BasesDeDefenseRepository $basesDeDefenseRepository, RfzRepository $RfzRepository, ContactRepository $contactRepository)
    {
        $this->RfzRepository = $RfzRepository;
        $this->BasesDeDefenseRepository = $basesDeDefenseRepository;
        $this->ContactRepository = $contactRepository;
    }

    /**
     * @Route ("/Admin", name="Admin")
     * @return Response
     */
    public function index() : Response{
        return $this->render('administration/admin.html.twig', [
            'nbBdd' => count($this->BasesDeDefenseRepository->findAll()),
            'nbRfz' => count($this->RfzRepository->findAll()),
            'nbContact' => count($this->ContactRepository->findAll()),
        ]);
    }
}