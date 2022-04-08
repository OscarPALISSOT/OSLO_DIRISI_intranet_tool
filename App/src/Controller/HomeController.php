<?php

namespace App\Controller;

use App\Repository\BasesDeDefenseRepository;
use App\Repository\QuartiersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {

    private $basesDeDefenseRepository;
    private $quartiersRepository;

    public function __construct(BasesDeDefenseRepository $basesDeDefenseRepository, QuartiersRepository $quartiersRepository)
    {
        $this->basesDeDefenseRepository = $basesDeDefenseRepository;
        $this->quartiersRepository = $quartiersRepository;
    }


    public function index() : Response{

        $BddId = $this->basesDeDefenseRepository->findId();

        return $this->render('pages/home.html.twig', [
            'Bdds' => $this->basesDeDefenseRepository->findAll(),
            'Quartiers' => $this->quartiersRepository->findAll(),
            'BddId' => $BddId,
        ]);
    }
}