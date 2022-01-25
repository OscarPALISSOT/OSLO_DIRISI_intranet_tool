<?php

namespace App\Controller\administration\contact;

use App\Repository\ContactbddRepository;
use App\Repository\ContactCirisiRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminContactController extends AbstractController
{

    private ContactRepository $ContactRepository;
    private ContactCirisiRepository $ContactCirisiRepository;
    private ContactbddRepository $contactbddRepository;

    public function __construct(ContactRepository $ContactRepository, ContactCirisiRepository $ContactCirisiRepository, ContactbddRepository $contactbddRepository)
    {
        $this->ContactRepository = $ContactRepository;
        $this->ContactCirisiRepository = $ContactCirisiRepository;
        $this->contactbddRepository = $contactbddRepository;
    }

    /**
     * @Route ("/Admin/AdminContacts", name="Admin_contacts")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('administration/Contact/AdminContacts.html.twig', [
            'nbContact' => count($this->ContactRepository->findAll()),
            'nbContactCirisi' => count($this->ContactCirisiRepository->findAll()),
            'nbContactBdd' => count($this->contactbddRepository->findAll()),
        ]);
    }
}
