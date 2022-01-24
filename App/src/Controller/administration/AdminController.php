<?php

namespace App\Controller\administration;

use App\Repository\BasesDeDefenseRepository;
use App\Repository\CirisiRepository;
use App\Repository\ContactCirisiRepository;
use App\Repository\ContactRepository;
use App\Repository\QuartiersRepository;
use App\Repository\RfzRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController {

    private RfzRepository $RfzRepository;
    private BasesDeDefenseRepository $BasesDeDefenseRepository;
    private ContactRepository $ContactRepository;
    private ContactCirisiRepository $contactCirisiRepository;
    private CirisiRepository $cirisiRepository;
    private QuartiersRepository $quartiersRepository;

    public function __construct(BasesDeDefenseRepository $basesDeDefenseRepository, RfzRepository $RfzRepository, ContactRepository $contactRepository, ContactCirisiRepository $contactCirisiRepository, CirisiRepository $cirisiRepository, QuartiersRepository $quartiersRepository)
    {
        $this->RfzRepository = $RfzRepository;
        $this->BasesDeDefenseRepository = $basesDeDefenseRepository;
        $this->ContactRepository = $contactRepository;
        $this->contactCirisiRepository = $contactCirisiRepository;
        $this->cirisiRepository = $cirisiRepository;
        $this->quartiersRepository = $quartiersRepository;
    }

    /**
     * @Route ("/Admin", name="Admin")
     * @return Response
     */
    public function index() : Response{
        return $this->render('administration/admin.html.twig', [
            'nbBdd' => count($this->BasesDeDefenseRepository->findAll()),
            'nbRfz' => count($this->RfzRepository->findAll()),
            'nbContact' => count($this->ContactRepository->findAll() + $this->contactCirisiRepository->findAll()),
            'nbCirisi' => count($this->cirisiRepository->findAll()),
            'nbQuartier' => count($this->quartiersRepository->findAll()),
        ]);
    }
}