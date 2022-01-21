<?php

namespace App\Controller\administration;

use App\Repository\ContactCirisiRepository;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminContactController extends AbstractController
{

    private ContactRepository $ContactRepository;
    private ContactCirisiRepository $ContactCirisiRepository;

    public function __construct(ContactRepository $ContactRepository, ContactCirisiRepository $ContactCirisiRepository)
    {
        $this->ContactRepository = $ContactRepository;
        $this->ContactCirisiRepository = $ContactCirisiRepository;
    }

    /**
     * @Route ("/Admin/AdminContacts", name="Admin_contacts")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('administration/Contact/AdminContacts.html.twig', [
            'nbContactBdd' => count($this->ContactRepository->findAll()),
            'nbContactCirisi' => count($this->ContactCirisiRepository->findAll()),
        ]);
    }
}
